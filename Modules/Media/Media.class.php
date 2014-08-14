<?php
namespace Modules\Media {
    /**
     * Media class
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
    class Media extends \Framework\Module\ModuleAbstract {
        /**
         * Dependencies
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $dependencies = null;

        /**
         * Providing
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $providing = [
            1004100000 => true,
            1004400000 => true
        ];

        /**
         * Receiving
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $receiving = null;

        /**
         * Parent links of the current page
         *
         * @var array
         * @since 1.0.0
         */
        public $nav_parents = null;

        /**
         * Constructor
         *
         * @param string $theme_path
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($theme_path, $app) {
            parent::initialize($theme_path, $app);
        }

        /**
         * Install module
         *
         * @param \Framework\DataStorage\Database\Database $db   Database instance
         * @param array                                    $info Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install(&$db, $info) {
            switch ($db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'media` (
                            `id` int(11) NOT NULL,
                            `name` datetime NOT NULL,
                            `file` varchar(255) NOT NULL,
                            `type` text NOT NULL,
                            `account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'media`
                            ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();
                    break;
            }

            parent::install_providing($db, __DIR__ . '/install/nav.install.json', 'Navigation');
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_content() {
            switch ($this->app->request->uri['l3']) {
                case 'single':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/media-single.tpl.php';
                    break;
                case 'list':
                    if (!isset($this->app->request->uri['page'])) {
                        $this->app->request->uri['page'] = 1;
                    }

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/media-list.tpl.php';
                    break;
                default:
                    return false;
            }

            return true;
        }

        public function show_content_push() {
            switch ($this->app->request->uri['l2']) {
                case 'admin':
                    break;
                case 'profile':
                    break;
            }
        }
    }
}