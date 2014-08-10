<?php
namespace Modules\News {
    /**
     * News class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class News extends \Framework\Modules\ModuleAbstract {
        /**
         * Dependencies
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $dependencies = null;

        /**
         * Receiving
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $receiving = null;

        /**
         * Constructor
         *
         * @param \Framework\Core\Database\Database $db    Database instance
         * @param \Framework\Core\Model    $model Model instance
         * @param \Framework\Core\User     $user  User instance
         * @param \Framework\Core\Cache    $cache Cache instance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct(&$db, &$model, &$user, &$cache) {
            parent::initialize($db, $model, $user, $cache);
        }

        /**
         * Install module
         *
         * @param \Framework\Core\Database\Database $db   Database instance
         * @param array              $info Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install(&$db, $info) {
            switch ($db->type) {
                case \Framework\Core\Database\DatabaseType::MYSQL:
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'news` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `title` varchar(250) NOT NULL,
                            `featured` tinyint(1) DEFAULT NULL,
                            `content` text NOT NULL,
                            `type` tinyint(2) NOT NULL,
                            `lang` tinyint(2) NOT NULL,
                            `created` datetime NOT NULL,
                            `author` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `author` (`author`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'news`
				            ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    break;
            }
        }

        /**
         * Install data from providing modules
         *
         * @param \Framework\Core\Database\Database $db   Database instance
         * @param array              $data Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install_external(&$db, $data) {
        }

        /**
         * Get news
         *
         * @param int $id News ID
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function news_get($id) {
            $news = null;

            switch ($this->db->type) {
                case 1:
                    $sth = $this->db->con->prepare('SELECT * FROM `' . $this->db->prefix . 'news` WHERE `id` = :id');
                    $sth->bindValue(':id', $id, \PDO::PARAM_INT);
                    $sth->execute();
                    $news = $sth->fetchAll();
                    break;
            }

            return $news;
        }

        public function news_list_get($filter = null, $offset = 0, $limit = 100) {
            switch ($this->db->type) {
                case 1:
                    $search = $this->model->generate_sql_filter($filter);

                    $sth = $this->db->con->prepare(
                        'SELECT * FROM `' . $this->db->prefix . 'news` WHERE ' . $search . 'OFFSET ' . $offset . ' LIMIT ' . $limit
                    );

                    $sth->execute();
                    break;
            }
        }

        /**
         * Get small news info
         *
         * @param int $id News ID
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function news_small_get($id) {
            $news = null;

            switch ($this->db->type) {
                case 1:
                    $sth = $this->db->con->prepare('SELECT `title`, `author`, `type`, `created` FROM `' . $this->db->prefix . 'news` WHERE `id` = :id');
                    $sth->bindValue(':id', $id, \PDO::PARAM_INT);
                    $sth->execute();
                    $news = $sth->fetchAll();
                    break;
            }

            return $news;
        }

        /**
         * Edit news
         *
         * @param int   $id   News ID
         * @param array $data News data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function news_edit($id, $data) {
            switch ($this->db->type) {
                case 1:
                    $sth = $this->db->con->prepare(
                        'UPDATE `' . $this->db->prefix . 'news` SET
                            `title` = :title,
                            `author` = :author,
                            `type` = :type,
                            `content` = :content,
                            `created` = :created,
                            `lang` = :lang,
                            `featured` = :featured WHERE `id` = :id;'
                    );

                    $sth->bindValue(':title', $data['title'], \PDO::PARAM_STR);
                    $sth->bindValue(':author', $data['author'], \PDO::PARAM_STR);
                    $sth->bindValue(':type', $data['type'], \PDO::PARAM_INT);
                    $sth->bindValue(':content', $data['content'], \PDO::PARAM_STR);
                    $sth->bindValue(':created', $data['created'], \PDO::PARAM_STR);
                    $sth->bindValue(':lang', $data['lang'], \PDO::PARAM_INT);
                    $sth->bindValue(':featured', $data['featured'], \PDO::PARAM_INT);
                    $sth->bindValue(':id', $id, \PDO::PARAM_INT);
                    $sth->execute();
                    break;
            }
        }

        /**
         * Create news post
         *
         * @param array $data News data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function news_create($data) {
            switch ($this->db->type) {
                case 1:
                    $sth = $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'news` (`title`, `author`, `type`, `content`, `created`, `lang`, `featured`) VALUES
                            (:title, :author, :type, :content, :created, :lang, :featured);'
                    );

                    $sth->bindValue(':title', $data['title'], \PDO::PARAM_STR);
                    $sth->bindValue(':author', $data['author'], \PDO::PARAM_STR);
                    $sth->bindValue(':type', $data['type'], \PDO::PARAM_INT);
                    $sth->bindValue(':content', $data['content'], \PDO::PARAM_STR);
                    $sth->bindValue(':created', $data['created'], \PDO::PARAM_STR);
                    $sth->bindValue(':lang', $data['lang'], \PDO::PARAM_INT);
                    $sth->bindValue(':featured', $data['featured'], \PDO::PARAM_INT);
                    $sth->execute();
                    break;
            }
        }

        /**
         * Delete news
         *
         * @param int $id News ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function news_delete($id) {
            switch ($this->db->type) {
                case 1:
                    $sth = $this->db->con->prepare('DELETE `' . $this->db->prefix . 'news` WHERE `id` = :id');
                    $sth->bindValue(':id', $id, \PDO::PARAM_INT);
                    $sth->execute();
                    break;
            }
        }

        /**
         * Shows module content for dashboard
         *
         * @para   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_dashboard($data) {

        }

        /**
         * Shows module content
         *
         * @para   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_content($data) {
            /* TODO: Page title doesn't work here, needs to move to the init. In the init it only should get initialized if != api */
            switch($data['l3']) {
                case 'front':
                    $this->model->data['page::title'] = \Framework\Localization\Localization::$lang[7]['NewsDashboard'];

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/news-front.tpl.php';
                    break;
                case 'single':
                    $this->model->data['page::title'] = \Framework\Localization\Localization::$lang[7]['News'] . ' ';

                    $news = null;

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/news-single.tpl.php';
                    break;
                case 'editor':
                    $this->model->data['page::title'] = \Framework\Localization\Localization::$lang[7]['NewsEditor'];

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/news-editor.tpl.php';
                    break;
                case 'archive':
                    $this->model->data['page::title'] = \Framework\Localization\Localization::$lang[7]['Archive'];

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/news-archive.tpl.php';
                    break;
            }
        }
    }
}