<?php
namespace Framework\Install {
    /**
     * Install class
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
    class Install {
        /**
         * Database object
         *
         * @var \Framework\DataStorage\Database\Database
         * @since 1.0.0
         */
        private $db = null;

        /**
         * Constructor
         *
         * @param \Framework\DataStorage\Database\Database $db Database instance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct(&$db) {
            $this->db = $db;
        }

        /**
         * Install the core elements of the software
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function install_core() {
            switch ($this->db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $this->db->con->beginTransaction();

                    /* Create groups table */
                    $this->db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $this->db->prefix . 'groups` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(50) NOT NULL,
                            `desc` varchar(100) DEFAULT NULL,
                            PRIMARY KEY (`id`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    /* Create groups relations table */
                    $this->db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $this->db->prefix . 'groups_relations` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `group` int(11) DEFAULT NULL,
                            `parent` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `group` (`group`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $this->db->con->prepare(
                        'ALTER TABLE `' . $this->db->prefix . 'groups_relations`
                            ADD CONSTRAINT `groups_relations_ibfk_1` FOREIGN KEY (`group`) REFERENCES `' . $this->db->prefix . 'groups` (`id`);'
                    )->execute();

                    /* Create groups permissions table */
                    $this->db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $this->db->prefix . 'groups_permissions` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `permission` int(11) NOT NULL,
                            `group` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `group` (`group`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $this->db->con->prepare(
                        'ALTER TABLE `' . $this->db->prefix . 'groups_permissions`
                            ADD CONSTRAINT `groups_permissions_ibfk_1` FOREIGN KEY (`group`) REFERENCES `' . $this->db->prefix . 'groups` (`id`);'
                    )->execute();

                    /* Create ips table
                       This gets used in order to prevent unauthorized access for user groups. */
                    $this->db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $this->db->prefix . 'ips` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `begin` bigint(20) NOT NULL,
                            `end` bigint(20) NOT NULL,
                            `group` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `group` (`group`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $this->db->con->prepare(
                        'ALTER TABLE `' . $this->db->prefix . 'ips`
                            ADD CONSTRAINT `ips_ibfk_1` FOREIGN KEY (`group`) REFERENCES `' . $this->db->prefix . 'groups` (`id`);'
                    )->execute();

                    /* Create modules table */
                    $this->db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $this->db->prefix . 'modules` (
                            `id` int(11) NOT NULL,
                            `name` varchar(100) NOT NULL,
                            `theme` varchar(100) DEFAULT NULL,
                            `path` varchar(50) NOT NULL,
                            `class` varchar(30) DEFAULT NULL,
                            `active` tinyint(1) NOT NULL DEFAULT 1,
                            `version` varchar(10) DEFAULT NULL,
                            `lang` tinyint(1) DEFAULT NULL,
                            `js` tinyint(1) DEFAULT NULL,
                            `css` tinyint(1) DEFAULT NULL,
                            PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
                    )->execute();

                    /* Create module load table */
                    $this->db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $this->db->prefix . 'modules_load` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `pid` varchar(40) NOT NULL,
                            `type` tinyint(1) NOT NULL,
                            `from` int(11) DEFAULT NULL,
                            `for` int(11) DEFAULT NULL,
                            `file` varchar(30) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `from` (`from`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $this->db->con->prepare(
                        'ALTER TABLE `' . $this->db->prefix . 'modules_load`
                            ADD CONSTRAINT `modules_load_ibfk_1` FOREIGN KEY (`from`) REFERENCES `' . $this->db->prefix . 'modules` (`id`);'
                    )->execute();

                    /* Create accounts table */
                    $this->db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $this->db->prefix . 'accounts` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `status` tinyint(2) NOT NULL,
                            `type` tinyint(2) NOT NULL,
                            `lactive` datetime NOT NULL,
                            `created` datetime NOT NULL,
                            `changed` tinyint(1) DEFAULT 1,
                            PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $this->db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $this->db->prefix . 'accounts_data` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `login` varchar(30) NOT NULL,
                            `name1` varchar(50) NOT NULL,
                            `name2` varchar(50) NOT NULL,
                            `name3` varchar(50) NOT NULL,
                            `password` varchar(64) NOT NULL,
                            `email` varchar(70) NOT NULL,
                            `tries` tinyint(2) NOT NULL DEFAULT 0,
                            `account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `account` (`account`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $this->db->con->prepare(
                        'ALTER TABLE `' . $this->db->prefix . 'accounts_data`
                            ADD CONSTRAINT `accounts_data_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $this->db->prefix . 'accounts` (`id`);'
                    )->execute();

                    /* Create accounts groups table */
                    $this->db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $this->db->prefix . 'accounts_groups` (
                            `id` bigint(20) NOT NULL AUTO_INCREMENT,
                            `group` int(11) NOT NULL,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `group` (`group`,`account`),
                            KEY `account` (`account`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $this->db->con->prepare(
                        'ALTER TABLE `' . $this->db->prefix . 'accounts_groups`
                            ADD CONSTRAINT `accounts_groups_ibfk_1` FOREIGN KEY (`group`) REFERENCES `' . $this->db->prefix . 'groups` (`id`),
                            ADD CONSTRAINT `accounts_groups_ibfk_2` FOREIGN KEY (`account`) REFERENCES `' . $this->db->prefix . 'accounts` (`id`);'
                    )->execute();

                    /* Create accounts settings table */
                    $this->db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $this->db->prefix . 'accounts_settings` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(30) NOT NULL,
                            `content` varchar(250) NOT NULL,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `name` (`name`),
                            KEY `account` (`account`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $this->db->con->prepare(
                        'ALTER TABLE `' . $this->db->prefix . 'accounts_settings`
                            ADD CONSTRAINT `accounts_settings_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $this->db->prefix . 'accounts` (`id`);'
                    )->execute();

                    /* Create settings table */
                    $this->db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $this->db->prefix . 'settings` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `module` int(11) DEFAULT NULL,
                            `name` varchar(100) NOT NULL,
                            `content` varchar(255) NOT NULL,
                            `group` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `module` (`module`, `group`),
                            KEY `group` (`group`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
                    )->execute();

                    $this->db->con->prepare(
                        'ALTER TABLE `' . $this->db->prefix . 'settings`
                            ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`module`) REFERENCES `' . $this->db->prefix . 'modules` (`id`),
                            ADD CONSTRAINT `settings_ibfk_2` FOREIGN KEY (`group`) REFERENCES `' . $this->db->prefix . 'groups` (`id`);'
                    )->execute();

                    $this->db->con->commit();
                    break;
            }
        }

        /**
         * Install the core modules
         *
         * @param array $modules Array of all modules to install
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function install_core_modules($modules) {
            foreach ($modules as $module) {
                /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
                \Framework\Module\ModuleAbstract::install($this->db, $module);
            }
        }

        /**
         * Setup the core groups
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function install_groups() {
            switch ($this->db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $this->db->con->beginTransaction();

                    $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'groups` (`id`, `name`, `desc`) VALUES
                            (1000000000, \'anonymous\', NULL),
                            (1000101000, \'user\', NULL),
                            (1000102000, \'admin\', NULL),
                            (1000103000, \'support\', NULL),
                            (1000104000, \'suspended\', NULL);'
                    )->execute();

                    $this->db->con->commit();
                    break;
            }
        }

        /**
         * Setup the admin user
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function install_users() {
            $date = new \DateTime("NOW", new \DateTimeZone('UTC'));

            switch ($this->db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $this->db->con->beginTransaction();

                    $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts` (`id`, `status`, `type`, `lactive`, `created`, `changed`) VALUES
                            (1, 0, 0, \'0000-00-00 00:00:00\', \'' . $date->format('Y-m-d H:i:s') . '\', 1);'
                    )->execute();

                    $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts_data` (`id`, `login`, `name1`, `name2`, `name3`, `password`, `email`, `tries`, `account`) VALUES
                            (1, \'admin\', \'Cherry\', \'Orange\', \'Orange Management\', \'yellowOrange\', \'admin@email.com\', 5, 1);'
                    )->execute();

                    $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts_groups` (`id`, `group`, `account`) VALUES
                            (1, 1000101000, 1)'
                    )->execute();

                    $this->db->con->commit();
                    break;
            }
        }

        /**
         * Set all settings
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function install_settings() {
            switch ($this->db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $this->db->con->beginTransaction();

                    $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'settings` (`id`, `module`, `name`, `content`, `group`) VALUES
                            (1000000001, NULL, \'username_length_max\', \'20\', NULL),
                            (1000000002, NULL, \'username_length_min\', \'5\', NULL),
                            (1000000003, NULL, \'password_length_max\', \'50\', NULL),
                            (1000000004, NULL, \'password_length_min\', \'5\', NULL),
                            (1000000005, NULL, \'login_tries\', \'3\', NULL),
                            (1000000006, NULL, \'pass_special\', \'1\', NULL),
                            (1000000007, NULL, \'pass_upper\', \'0\', NULL),
                            (1000000008, NULL, \'pass_numeric\', \'1\', NULL),
                            (1000000009, NULL, \'oname\', \'Orange Management\', NULL),
                            (1000000010, NULL, \'theme\', \'oms-slim\', NULL),
                            (1000000011, NULL, \'theme_path\', \'/oms-slim\', NULL),
                            (1000000012, NULL, \'changed\', \'1\', NULL),
                            (1000000013, NULL, \'login_status\', \'1\', NULL),
                            (1000000014, NULL, \'login_msg\', \'Maintenance scheduled for tomorrow from 11:00 am to 1:00 pm.\', NULL),
                            (1000000015, NULL, \'use_cache\', \'0\', NULL),
                            (1000000016, NULL, \'last_recache\', \'0000-00-00 00:00:00\', NULL),
                            (1000000017, NULL, \'public_access\', \'0\', NULL),
                            (1000000018, NULL, \'rewrite\', \'0\', NULL),
                            (1000000019, NULL, \'country\', \'DE\', NULL),
                            (1000000020, NULL, \'language\', \'en\', NULL),
                            (1000000021, NULL, \'timezone\', \'Europe/Berlin\', NULL),
                            (1000000022, NULL, \'timeformat\', \'DD.MM.YYYY ss:mm:hh\', NULL),
                            (1000000023, NULL, \'currency\', \'USD\', NULL),
                            (1000000024, NULL, \'pass_lower\', \'1\', NULL),
                            (1000000025, NULL, \'mail_admin\', \'mail@admin.com\', NULL),
                            (1000000026, NULL, \'login_name\', \'1\', NULL)'
                    )->execute();

                    $this->db->con->commit();
                    break;
            }
        }
    }
}