<?php
namespace phpOMS\Install;

/**
 * Install class
 *
 * PHP Version 5.4
 *
 * @category   Install
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Install
{
    /**
     * Database object
     *
     * @var \phpOMS\DataStorage\Database\Database
     * @since 1.0.0
     */
    private $db = null;

    /**
     * Constructor
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($dbPool)
    {
        $this->dbPool = $dbPool;
    }

    /**
     * Install the core elements of the software
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function installCore()
    {
        switch($this->dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $this->dbPool->get('core')->con->beginTransaction();

                /* Create group table */
                $this->dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'group` (
                            `group_id` int(11) NOT NULL AUTO_INCREMENT,
                            `group_name` varchar(50) NOT NULL,
                            `group_desc` varchar(100) DEFAULT NULL,
                            PRIMARY KEY (`group_id`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                /* Create group relations table */
                $this->dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'group_relations` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `group` int(11) DEFAULT NULL,
                            `parent` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `group` (`group`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $this->dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $this->dbPool->get('core')->prefix . 'group_relations`
                            ADD CONSTRAINT `' . $this->dbPool->get('core')->prefix . 'group_relations_ibfk_1` FOREIGN KEY (`group`) REFERENCES `' . $this->dbPool->get('core')->prefix . 'group` (`group_id`);'
                )->execute();

                /* Create group permission table */
                $this->dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'group_permission` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `permission` int(11) NOT NULL,
                            `group` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `group` (`group`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $this->dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $this->dbPool->get('core')->prefix . 'group_permission`
                            ADD CONSTRAINT `' . $this->dbPool->get('core')->prefix . 'group_permission_ibfk_1` FOREIGN KEY (`group`) REFERENCES `' . $this->dbPool->get('core')->prefix . 'group` (`group_id`);'
                )->execute();

                /* Create ips table
                   This gets used in order to prevent unauthorized access for user group. */
                $this->dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'ips` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `begin` bigint(20) NOT NULL,
                            `end` bigint(20) NOT NULL,
                            `group` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `group` (`group`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $this->dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $this->dbPool->get('core')->prefix . 'ips`
                            ADD CONSTRAINT `' . $this->dbPool->get('core')->prefix . 'ips_ibfk_1` FOREIGN KEY (`group`) REFERENCES `' . $this->dbPool->get('core')->prefix . 'group` (`group_id`);'
                )->execute();

                /* Create module table */
                $this->dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'module` (
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
                $this->dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'module_load` (
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

                $this->dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $this->dbPool->get('core')->prefix . 'module_load`
                            ADD CONSTRAINT `' . $this->dbPool->get('core')->prefix . 'module_load_ibfk_1` FOREIGN KEY (`from`) REFERENCES `' . $this->dbPool->get('core')->prefix . 'module` (`id`);'
                )->execute();

                /* Create account table */
                $this->dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'account` (
                            `account_id` int(11) NOT NULL AUTO_INCREMENT,
                            `account_status` tinyint(2) NOT NULL,
                            `account_type` tinyint(2) NOT NULL,
                            `account_lactive` datetime NOT NULL,
                            `account_created` datetime NOT NULL,
                            `account_changed` tinyint(1) DEFAULT 1,
                            PRIMARY KEY (`account_id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $this->dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'account_data` (
                            `account_data_id` int(11) NOT NULL AUTO_INCREMENT,
                            `account_data_login` varchar(30) NOT NULL,
                            `account_data_name1` varchar(50) NOT NULL,
                            `account_data_name2` varchar(50) NOT NULL,
                            `account_data_name3` varchar(50) NOT NULL,
                            `account_data_password` varchar(64) NOT NULL,
                            `account_data_email` varchar(70) NOT NULL,
                            `account_data_tries` tinyint(2) NOT NULL DEFAULT 0,
                            `account_data_account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`account_data_id`),
                            KEY `account_data_account` (`account_data_account`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $this->dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $this->dbPool->get('core')->prefix . 'account_data`
                            ADD CONSTRAINT `' . $this->dbPool->get('core')->prefix . 'account_data_ibfk_1` FOREIGN KEY (`account_data_account`) REFERENCES `' . $this->dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                /* Create account group table */
                $this->dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'account_group` (
                            `id` bigint(20) NOT NULL AUTO_INCREMENT,
                            `group` int(11) NOT NULL,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `group` (`group`),
                            KEY `account` (`account`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $this->dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $this->dbPool->get('core')->prefix . 'account_group`
                            ADD CONSTRAINT `' . $this->dbPool->get('core')->prefix . 'account_group_ibfk_1` FOREIGN KEY (`group`) REFERENCES `' . $this->dbPool->get('core')->prefix . 'group` (`group_id`),
                            ADD CONSTRAINT `' . $this->dbPool->get('core')->prefix . 'account_group_ibfk_2` FOREIGN KEY (`account`) REFERENCES `' . $this->dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                /* Create account settings table */
                $this->dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'account_settings` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(30) NOT NULL,
                            `content` varchar(250) NOT NULL,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `name` (`name`),
                            KEY `account` (`account`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $this->dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $this->dbPool->get('core')->prefix . 'account_settings`
                            ADD CONSTRAINT `' . $this->dbPool->get('core')->prefix . 'account_settings_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $this->dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                /* Create settings table */
                $this->dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $this->dbPool->get('core')->prefix . 'settings` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `module` int(11) DEFAULT NULL,
                            `name` varchar(100) NOT NULL,
                            `content` varchar(255) NOT NULL,
                            `group` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `module` (`module`),
                            KEY `group` (`group`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
                )->execute();

                $this->dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $this->dbPool->get('core')->prefix . 'settings`
                            ADD CONSTRAINT `' . $this->dbPool->get('core')->prefix . 'settings_ibfk_1` FOREIGN KEY (`module`) REFERENCES `' . $this->dbPool->get('core')->prefix . 'module` (`id`),
                            ADD CONSTRAINT `' . $this->dbPool->get('core')->prefix . 'settings_ibfk_2` FOREIGN KEY (`group`) REFERENCES `' . $this->dbPool->get('core')->prefix . 'group` (`group_id`);'
                )->execute();

                $this->dbPool->get('core')->con->commit();
                break;
        }
    }

    /**
     * Install the core module
     *
     * @param array $modules Array of all module to install
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function installModules($modules)
    {
        $moduleManager = new \phpOMS\Module\ModuleManager($this->dbPool);

        foreach($modules as $module) {
            $moduleManager->install($module);
        }
    }

    /**
     * Setup the core group
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function installGroups()
    {
        switch($this->dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $this->dbPool->get('core')->con->beginTransaction();

                $this->dbPool->get('core')->con->prepare(
                    'INSERT INTO `' . $this->dbPool->get('core')->prefix . 'group` (`group_id`, `group_name`, `group_desc`) VALUES
                            (1000000000, \'anonymous\', NULL),
                            (1000101000, \'user\', NULL),
                            (1000102000, \'admin\', NULL),
                            (1000103000, \'support\', NULL),
                            (1000104000, \'suspended\', NULL);'
                )->execute();

                $this->dbPool->get('core')->con->commit();
                break;
        }
    }

    /**
     * Setup the admin user
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function installUsers()
    {
        $date = new \DateTime("NOW", new \DateTimeZone('UTC'));

        switch($this->dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $this->dbPool->get('core')->con->beginTransaction();

                $this->dbPool->get('core')->con->prepare(
                    'INSERT INTO `' . $this->dbPool->get('core')->prefix . 'account` (`account_id`, `account_status`, `account_type`, `account_lactive`, `account_created`, `account_changed`) VALUES
                            (1, 0, 0, \'0000-00-00 00:00:00\', \'' . $date->format('Y-m-d H:i:s') . '\', 1);'
                )->execute();

                $this->dbPool->get('core')->con->prepare(
                    'INSERT INTO `' . $this->dbPool->get('core')->prefix . 'account_data` (`account_data_id`, `account_data_login`, `account_data_name1`, `account_data_name2`, `account_data_name3`, `account_data_password`, `account_data_email`, `account_data_tries`, `account_data_account`) VALUES
                            (1, \'admin\', \'Cherry\', \'Orange\', \'Orange Management\', \'yellowOrange\', \'admin@email.com\', 5, 1);'
                )->execute();

                $this->dbPool->get('core')->con->prepare(
                    'INSERT INTO `' . $this->dbPool->get('core')->prefix . 'account_group` (`id`, `group`, `account`) VALUES
                            (1, 1000101000, 1)'
                )->execute();

                $this->dbPool->get('core')->con->commit();
                break;
        }
    }

    /**
     * Set all settings
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function installSettings()
    {
        switch($this->dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $this->dbPool->get('core')->con->beginTransaction();

                $this->dbPool->get('core')->con->prepare(
                    'INSERT INTO `' . $this->dbPool->get('core')->prefix . 'settings` (`id`, `module`, `name`, `content`, `group`) VALUES
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

                $this->dbPool->get('core')->con->commit();
                break;
        }
    }

    /**
     * Create dummy data
     *
     * @param array $toDummy Dummy data array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function installDummy($toDummy)
    {
        $this->dbPool->get('core')->con->beginTransaction();

        $a = "INSERT INTO `" . $this->dbPool->get('core')->prefix . "account` (`status`, `type`, `lactive`, `created`, `changed`) VALUES";
        $b = "INSERT INTO `" . $this->dbPool->get('core')->prefix . "account_data` (`login`, `name1`, `name2`, `name3`, `password`, `email`, `tries`, `account`) VALUES";
        $c = "INSERT INTO `" . $this->dbPool->get('core')->prefix . "account_group` (`group`, `account`) VALUES";

        $valA = '';
        $valB = '';
        $valC = '';

        for($i = 2; $i < 9998; $i++) {
            $valA .= " (" . rand(0, 1) . ", " . rand(0, 3) . ", '0000-00-00 00:00:00', '" . \phpOMS\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', " . rand(0, 1) . "),";
            $valB .= " ('" . strtolower(\phpOMS\Utils\RnG\Name::generateName(['male',
                                                                              'female'])) . "', '" . \phpOMS\Utils\RnG\Name::generateName(['male',
                                                                                                                                           'female']) . "', '" . \phpOMS\Utils\RnG\Name::generateName(['family']) . "', 'Orange Management', 'yellowOrange', '" . \phpOMS\Utils\RnG\Name::generateName(['male',
                                                                                                                                                                                                                                                                                                        'female']) . "@email.com', " . rand(0, 5) . ", " . $i . "),";
            $valC .= " (1000101000, 1),";
        }

        $valA = rtrim($valA, ',');
        $valB = rtrim($valB, ',');
        $valC = rtrim($valC, ',');

        $this->dbPool->get('core')->con->prepare($a . $valA)->execute();
        $this->dbPool->get('core')->con->prepare($b . $valB)->execute();
        $this->dbPool->get('core')->con->prepare($c . $valC)->execute();

        $this->dbPool->get('core')->con->commit();

        foreach($toDummy as $dummy) {
            \phpOMS\Install\DummyFactory::generate($this->dbPool, $dummy);
        }
    }
}
