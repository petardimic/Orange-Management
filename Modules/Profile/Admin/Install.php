<?php
namespace Modules\Profile\Admin {
    /**
     * Navigation class
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
    class Install extends \Framework\Install\Module
    {
        /**
         * Install module
         *
         * @param \Framework\DataStorage\Database\Database $db   Database instance
         * @param array                                    $info Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install(&$db, $info)
        {
            switch($db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'profile_account` (
                            `profile_account_id` int(11) NOT NULL,
                            `profile_account_begin` datetime NOT NULL,
                            `profile_account_image` varchar(255) NOT NULL,
                            `profile_account_cv` text NOT NULL,
                            `profile_account_account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`profile_account_id`),
                            KEY `profile_account_account` (`profile_account_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'profile_account`
                            ADD CONSTRAINT `' . $db->prefix . 'profile_account_ibfk_1` FOREIGN KEY (`profile_account_account`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'profile_phone` (
                            `profile_phone_id` int(11) NOT NULL,
                            `profile_phone_type` tinyint(2) NOT NULL,
                            `profile_phone_number` varchar(50) NOT NULL,
                            `profile_phone_account` int(11) NOT NULL,
                            PRIMARY KEY (`ProfilePhoneID`),
                            KEY `profile_phone_account` (`profile_phone_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'profile_phone`
                            ADD CONSTRAINT `' . $db->prefix . 'profile_phone_ibfk_1` FOREIGN KEY (`profile_phone_account`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'profile_address` (
                            `profile_address_id` int(11) NOT NULL,
                            `profile_address_type` tinyint(2) NOT NULL,
                            `profile_address_address` varchar(50) NOT NULL,
                            `profile_address_street` varchar(50) NOT NULL,
                            `profile_address_city` varchar(50) NOT NULL,
                            `profile_address_zip` varchar(50) NOT NULL,
                            `profile_address_country` varchar(50) NOT NULL,
                            `profile_address_account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`profile_address_id`),
                            KEY `profile_address_account` (`profile_address_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'profile_address`
                            ADD CONSTRAINT `' . $db->prefix . 'profile_address_ibfk_1` FOREIGN KEY (`profile_address_account`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'profile_account_relation` (
                            `profile_account_relation_id` int(11) NOT NULL,
                            `profile_account_relation_type` tinyint(2) NOT NULL,
                            `profile_account_relation_relation` int(11) DEFAULT NULL,
                            `profile_account_relation_account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`profile_account_relation_id`),
                            KEY `profile_account_relation_account` (`profile_account_relation_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'profile_account_relation`
                            ADD CONSTRAINT `' . $db->prefix . 'profile_account_relation_ibfk_1` FOREIGN KEY (`profile_account_relation_account`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'profile_account_setting` (
                            `profile_account_setting_id` int(11) NOT NULL,
                            `profile_account_setting_module` int(11) NOT NULL,
                            `profile_account_setting_type` varchar(20) NOT NULL,
                            `profile_account_setting_value` varchar(32) DEFAULT NULL,
                            `profile_account_setting_account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`profile_account_setting_id`),
                            KEY `profile_account_setting_account` (`profile_account_setting_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'profile_account_setting`
                            ADD CONSTRAINT `' . $db->prefix . 'profile_account_setting_ibfk_1` FOREIGN KEY (`profile_account_setting_account`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}