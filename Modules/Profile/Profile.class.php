<?php
namespace Modules\Profile {
    /**
     * Profile class
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
    class Profile extends \Framework\Module\ModuleAbstract {
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
        public function __construct($theme_path) {
            parent::initialize($theme_path);
        }

        /**
         * Install module
         *
         * @param \Framework\DataStorage\Database\Database $db   Database instance
         * @param array              $info Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install(&$db, $info) {
            switch ($db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'profile_account` (
                            `id` int(11) NOT NULL,
                            `begin` datetime NOT NULL,
                            `image` varchar(255) NOT NULL,
                            `cv` text NOT NULL,
                            `account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'profile_account`
                            ADD CONSTRAINT `profile_account_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'profile_phone` (
                            `id` int(11) NOT NULL,
                            `type` tinyint(2) NOT NULL,
                            `number` varchar(50) NOT NULL,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'profile_phone`
                            ADD CONSTRAINT `profile_phone_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'profile_address` (
                            `id` int(11) NOT NULL,
                            `type` tinyint(2) NOT NULL,
                            `address` varchar(50) NOT NULL,
                            `street` varchar(50) NOT NULL,
                            `city` varchar(50) NOT NULL,
                            `zip` varchar(50) NOT NULL,
                            `country` varchar(50) NOT NULL,
                            `account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'profile_address`
                            ADD CONSTRAINT `profile_address_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'profile_account_relations` (
                            `id` int(11) NOT NULL,
                            `type` tinyint(2) NOT NULL,
                            `relation` int(11) DEFAULT NULL,
                            `account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'profile_account_relations`
                            ADD CONSTRAINT `profile_account_relations_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
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
            switch ($this->request->uri['l3']) {
                case 'single':
                    /** TODO: request navigation access in order to modify navigation. remove (temporary) settings link if not own profile */
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/profile-single.tpl.php';

                    $this->show_push();

                    break;
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $accounts = \Modules\Admin\Users::getInstance();

                    if (!isset($this->request->uri['page'])) {
                        $this->request->uri['page'] = 1;
                    }

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/profile-list.tpl.php';
                    break;
                default:
                    return false;
            }

            return true;
        }
    }
}