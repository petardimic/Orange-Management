<?php
namespace Modules\Calendar\Admin {
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'calendar` (
                            `CalendarID` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(25) NOT NULL,
                            `password` varchar(64) NOT NULL,
                            `description` varchar(255) NOT NULL,
                            `creator` int(11) NOT NULL,
                            `created` datetime NOT NULL,
                            PRIMARY KEY (`CalendarID`),
                            KEY `creator` (`creator`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'calendar`
                            ADD CONSTRAINT `calendar_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'calendar_permissions` (
                            `CalendarPermissionID` int(11) NOT NULL AUTO_INCREMENT,
                            `person` int(11) NOT NULL,
                            `calendar` int(11) NOT NULL,
                            `permission` tinyint(2) NOT NULL,
                            PRIMARY KEY (`CalendarPermissionID`),
                            KEY `person` (`person`),
                            KEY `calendar` (`calendar`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'calendar_permissions`
                            ADD CONSTRAINT `calendar_permissions_ibfk_1` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'accounts` (`id`),
                            ADD CONSTRAINT `calendar_permissions_ibfk_2` FOREIGN KEY (`calendar`) REFERENCES `' . $db->prefix . 'calendar` (`CalendarID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'calendar_event` (
                            `CalendarEventID` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(25) NOT NULL,
                            `description` varchar(255) NOT NULL,
                            `start` datetime NOT NULL,
                            `end` datetime NOT NULL,
                            `status` tinyint(1) NOT NULL,
                            `repeat` tinyint(1) NOT NULL,
                            `rep_interval` tinyint(3) NOT NULL,
                            `rep_monday` tinyint(1) NOT NULL,
                            `rep_tuesday` tinyint(1) NOT NULL,
                            `rep_wednesday` tinyint(1) NOT NULL,
                            `rep_thursday` tinyint(1) NOT NULL,
                            `rep_friday` tinyint(1) NOT NULL,
                            `rep_saturday` tinyint(1) NOT NULL,
                            `rep_sunday` tinyint(1) NOT NULL,
                            `creator` int(11) NOT NULL,
                            `created` datetime NOT NULL,
                            `calendar` int(11) NOT NULL,
                            PRIMARY KEY (`CalendarEventID`),
                            KEY `creator` (`creator`),
                            KEY `calendar` (`calendar`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'calendar_event`
                            ADD CONSTRAINT `calendar_event_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'accounts` (`id`),
                            ADD CONSTRAINT `calendar_event_ibfk_2` FOREIGN KEY (`calendar`) REFERENCES `' . $db->prefix . 'calendar` (`CalendarID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'calendar_event_participants` (
                            `CalendarEventParticipantsID` int(11) NOT NULL AUTO_INCREMENT,
                            `event` int(11) NOT NULL,
                            `person` int(11) NOT NULL,
                            `status` tinyint(1) NOT NULL,
                            PRIMARY KEY (`CalendarEventParticipantsID`),
                            KEY `event` (`event`),
                            KEY `person` (`person`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'calendar_event_participants`
                            ADD CONSTRAINT `calendar_event_participants_ibfk_1` FOREIGN KEY (`event`) REFERENCES `' . $db->prefix . 'calendar_event` (`CalendarEventID`),
                            ADD CONSTRAINT `calendar_event_participants_ibfk_2` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}