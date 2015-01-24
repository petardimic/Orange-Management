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
                            `ChatRoomID` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(25) NOT NULL,
                            `password` varchar(64) NOT NULL,
                            `description` varchar(255) NOT NULL,
                            `creator` int(11) NOT NULL,
                            `created` datetime NOT NULL,
                            PRIMARY KEY (`ChatRoomID`),
                            KEY `creator` (`creator`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'calendar`
                            ADD CONSTRAINT `chat_room_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'chat_room_permissions` (
                            `ChatRoomPermissionID` int(11) NOT NULL AUTO_INCREMENT,
                            `person` int(11) NOT NULL,
                            `room` int(11) NOT NULL,
                            `permission` tinyint(1) NOT NULL,
                            PRIMARY KEY (`ChatRoomPermissionID`),
                            KEY `person` (`person`),
                            KEY `room` (`room`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'calendar_permissions`
                            ADD CONSTRAINT `chat_room_permissions_ibfk_1` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'accounts` (`id`),
                            ADD CONSTRAINT `chat_room_permissions_ibfk_2` FOREIGN KEY (`room`) REFERENCES `' . $db->prefix . 'chat_room` (`ChatRoomID`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}