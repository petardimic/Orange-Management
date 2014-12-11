<?php
namespace Modules\News {
    /**
     * News class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Handler extends \Framework\Module\ModuleAbstract implements \Framework\Module\WebInterface {
        /**
         * Providing
         *
         * @var string
         * @since 1.0.0
         */
        public static $providing = [
            'Content',
            1004400000
        ];

        /**
         * Dependencies
         *
         * @var string
         * @since 1.0.0
         */
        public static $dependencies = [
        ];

        /**
         * Constructor
         *
         * @param string                    $themePath
         * @param \Framework\WebApplication $app Application reference
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app, $themePath) {
            parent::__construct($app, $themePath);
        }

        /**
         * Get modules this module is providing for
         *
         * @return array Providing
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getProviding() {
            return self::$providing;
        }

        /**
         * Get dependencies for this module
         *
         * @return array Dependencies
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getDependencies() {
            return self::$dependencies;
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

            switch($this->app->db->getType()) {
                case 1:
                    $sth = $this->app->db->con->prepare('SELECT * FROM `' . $this->app->db->prefix . 'news` WHERE `id` = :id');
                    $sth->bindValue(':id', $id, \PDO::PARAM_INT);
                    $sth->execute();
                    $news = $sth->fetchAll();
                    break;
            }

            return $news;
        }

        public function news_list_get($filter = null, $offset = 0, $limit = 100) {
            switch($this->app->db->getType()) {
                case 1:
                    $search = $this->model->generate_sql_filter($filter);

                    $sth = $this->app->db->con->prepare(
                        'SELECT * FROM `' . $this->app->db->prefix . 'news` WHERE ' . $search . 'OFFSET ' . $offset . ' LIMIT ' . $limit
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

            switch($this->app->db->getType()) {
                case 1:
                    $sth = $this->app->db->con->prepare('SELECT `title`, `author`, `type`, `created` FROM `' . $this->app->db->prefix . 'news` WHERE `id` = :id');
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
            switch($this->app->db->getType()) {
                case 1:
                    $sth = $this->app->db->con->prepare(
                        'UPDATE `' . $this->app->db->prefix . 'news` SET
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
            switch($this->app->db->getType()) {
                case 1:
                    $sth = $this->app->db->con->prepare(
                        'INSERT INTO `' . $this->app->db->prefix . 'news` (`title`, `author`, `type`, `content`, `created`, `lang`, `featured`) VALUES
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
            switch($this->app->db->getType()) {
                case 1:
                    $sth = $this->app->db->con->prepare('DELETE `' . $this->app->db->prefix . 'news` WHERE `id` = :id');
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
        public function callWeb() {
            switch($this->app->request->getType()) {
                case \Framework\Request\WebRequestPage::BACKEND:
                    $this->show_content_backend();
                    break;
            }
        }

        public function show_content_backend() {
            switch($this->app->request->request['l3']) {
                case 'dashboard':
                    $newsList = new \Modules\News\NewsList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/news-dashboard.tpl.php';
                    break;
                case 'single':
                    $article = new \Modules\News\Article($this->app->db);
                    $article->init($this->app->request->request['id']);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/news-single.tpl.php';
                    break;
                case 'archive':
                    $newsList = new \Modules\News\NewsList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/news-archive.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/news-create.tpl.php';
                    break;
            }
        }
    }
}