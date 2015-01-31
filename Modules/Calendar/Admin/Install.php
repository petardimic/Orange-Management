<?php
namespace Modules\Calendar\Admin;

/**
 * Calendar install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Calendar
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
        switch($dbPool->get('core')->getType()) {
            case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'calendar` (
                            `calendar_id` int(11) NOT NULL AUTO_INCREMENT,
                            `calendar_name` varchar(25) NOT NULL,
                            `calendar_password` varchar(64) NOT NULL,
                            `calendar_description` varchar(255) NOT NULL,
                            `calendar_creator` int(11) NOT NULL,
                            `calendar_created` datetime NOT NULL,
                            PRIMARY KEY (`calendar_id`),
                            KEY `calendar_creator` (`calendar_creator`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'calendar`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_ibfk_1` FOREIGN KEY (`calendar_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'calendar_permission` (
                            `calendar_permission_id` int(11) NOT NULL AUTO_INCREMENT,
                            `calendar_permission_account` int(11) NOT NULL,
                            `calendar_permission_calendar` int(11) NOT NULL,
                            `calendar_permission_permission` tinyint(2) NOT NULL,
                            PRIMARY KEY (`calendar_permission_id`),
                            KEY `calendar_permission_account` (`calendar_permission_account`),
                            KEY `calendar_permission_calendar` (`calendar_permission_calendar`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'calendar_permission`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_permission_ibfk_1` FOREIGN KEY (`calendar_permission_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_permission_ibfk_2` FOREIGN KEY (`calendar_permission_calendar`) REFERENCES `' . $dbPool->get('core')->prefix . 'calendar` (`calendar_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'calendar_event` (
                            `calendar_event_id` int(11) NOT NULL AUTO_INCREMENT,
                            `calendar_event_name` varchar(25) NOT NULL,
                            `calendar_event_description` varchar(255) NOT NULL,
                            `calendar_event_start` datetime NOT NULL,
                            `calendar_event_end` datetime NOT NULL,
                            `calendar_event_status` tinyint(1) NOT NULL,
                            `calendar_event_repeat` tinyint(1) NOT NULL,
                            `calendar_event_rep_interval` tinyint(3) NOT NULL,
                            `calendar_event_rep_monday` tinyint(1) NOT NULL,
                            `calendar_event_rep_tuesday` tinyint(1) NOT NULL,
                            `calendar_event_rep_wednesday` tinyint(1) NOT NULL,
                            `calendar_event_rep_thursday` tinyint(1) NOT NULL,
                            `calendar_event_rep_friday` tinyint(1) NOT NULL,
                            `calendar_event_rep_saturday` tinyint(1) NOT NULL,
                            `calendar_event_rep_sunday` tinyint(1) NOT NULL,
                            `calendar_event_creator` int(11) NOT NULL,
                            `calendar_event_created` datetime NOT NULL,
                            `calendar_event_calendar` int(11) NOT NULL,
                            PRIMARY KEY (`calendar_event_id`),
                            KEY `calendar_event_creator` (`calendar_event_creator`),
                            KEY `calendar_event_calendar` (`calendar_event_calendar`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'calendar_event`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_event_ibfk_1` FOREIGN KEY (`calendar_event_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_event_ibfk_2` FOREIGN KEY (`calendar_event_calendar`) REFERENCES `' . $dbPool->get('core')->prefix . 'calendar` (`calendar_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'calendar_event_participant` (
                            `calendar_event_participant_id` int(11) NOT NULL AUTO_INCREMENT,
                            `calendar_event_participant_event` int(11) NOT NULL,
                            `calendar_event_participant_person` int(11) NOT NULL,
                            `calendar_event_participant_status` tinyint(1) NOT NULL,
                            PRIMARY KEY (`calendar_event_participant_id`),
                            KEY `calendar_event_participant_event` (`calendar_event_participant_event`),
                            KEY `calendar_event_participant_person` (`calendar_event_participant_person`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'calendar_event_participant`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_event_participant_ibfk_1` FOREIGN KEY (`calendar_event_participant_event`) REFERENCES `' . $dbPool->get('core')->prefix . 'calendar_event` (`calendar_event_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'calendar_event_participant_ibfk_2` FOREIGN KEY (`calendar_event_participant_person`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();
                break;
        }

        parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
    }
}