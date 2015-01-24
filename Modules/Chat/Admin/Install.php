<?php
namespace Modules\Chat\Admin {
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'chat_room` (
                            `chat_room_id` int(11) NOT NULL AUTO_INCREMENT,
                            `chat_room_name` varchar(25) NOT NULL,
                            `chat_room_password` varchar(64) NOT NULL,
                            `chat_room_description` varchar(255) NOT NULL,
                            `chat_room_creator` int(11) NOT NULL,
                            `chat_room_created` datetime NOT NULL,
                            PRIMARY KEY (`chat_room_id`),
                            KEY `chat_room_creator` (`chat_room_creator`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'chat_room`
                            ADD CONSTRAINT `' . $db->prefix . 'chat_room_ibfk_1` FOREIGN KEY (`chat_room_creator`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'chat_room_permission` (
                            `chat_room_permission_id` int(11) NOT NULL AUTO_INCREMENT,
                            `chat_room_permission_account` int(11) NOT NULL,
                            `chat_room_permission_room` int(11) NOT NULL,
                            `chat_room_permission_permission` tinyint(1) NOT NULL,
                            PRIMARY KEY (`chat_room_permission_id`),
                            KEY `chat_room_permission_account` (`chat_room_permission_account`),
                            KEY `chat_room_permission_room` (`chat_room_permission_room`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'chat_room_permission`
                            ADD CONSTRAINT `' . $db->prefix . 'chat_room_permission_ibfk_1` FOREIGN KEY (`chat_room_permission_account`) REFERENCES `' . $db->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $db->prefix . 'chat_room_permission_ibfk_2` FOREIGN KEY (`chat_room_permission_room`) REFERENCES `' . $db->prefix . 'chat_room` (`chat_room_id`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}