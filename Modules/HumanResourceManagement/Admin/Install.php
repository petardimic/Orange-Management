<?php
namespace Modules\HumanResourceManagement\Admin;

/**
 * Human Resources install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\HumanResourceManagement
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
     * Install module
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database instance
     * @param array                             $info   Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'hr_staff` (
                            `hr_staff_id` int(11) NOT NULL AUTO_INCREMENT,
                            `hr_staff_status` tinyint(2) DEFAULT NULL,
                            `hr_staff_account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`hr_staff_id`),
                            KEY `hr_staff_account` (`hr_staff_account`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'hr_staff`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'hr_staff_ibfk_1` FOREIGN KEY (`hr_staff_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'hr_staff_history` (
                            `hr_staff_history_id` int(11) NOT NULL AUTO_INCREMENT,
                            `hr_staff_history_staff` int(11) DEFAULT NULL,
                            `hr_staff_history_position` int(11) DEFAULT NULL,
                            `hr_staff_history_department` int(11) DEFAULT NULL,
                            `hr_staff_history_start` datetime DEFAULT NULL,
                            `hr_staff_history_end` datetime DEFAULT NULL,
                            PRIMARY KEY (`hr_staff_history_id`),
                            KEY `hr_staff_history_staff` (`hr_staff_history_staff`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'hr_staff_history`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'hr_staff_history_ibfk_1` FOREIGN KEY (`hr_staff_history_staff`) REFERENCES `' . $dbPool->get('core')->prefix . 'hr_staff` (`hr_staff_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'hr_staff_contract` (
                            `hr_staff_contract_id` int(11) NOT NULL AUTO_INCREMENT,
                            `hr_staff_contract_stype` tinyint(1) DEFAULT NULL,
                            `hr_staff_contract_salary` decimal(8,2) DEFAULT NULL,
                            `hr_staff_contract_cformingbenefits` decimal(8,2) DEFAULT NULL,
                            `hr_staff_contract_working_hours` int(11) DEFAULT NULL,
                            `hr_staff_contract_vacation` tinyint(3) DEFAULT NULL,
                            `hr_staff_contract_vtype` tinyint(3) DEFAULT NULL,
                            `hr_staff_contract_personal_time` tinyint(3) DEFAULT NULL,
                            `hr_staff_contract_start` datetime DEFAULT NULL,
                            `hr_staff_contract_end` datetime DEFAULT NULL,
                            `hr_staff_contract_employee` int(11) DEFAULT NULL,
                            PRIMARY KEY (`hr_staff_contract_id`),
                            KEY `hr_staff_contract_employee` (`hr_staff_contract_employee`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'hr_staff_contract`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'hr_staff_contract_ibfk_1` FOREIGN KEY (`hr_staff_contract_employee`) REFERENCES `' . $dbPool->get('core')->prefix . 'hr_staff` (`hr_staff_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'hr_planning_shift` (
                            `HRPlanningShiftID` int(11) NOT NULL AUTO_INCREMENT,
                            `amount` int(11) DEFAULT NULL,
                            `position` int(11) DEFAULT NULL,
                            `department` int(11) DEFAULT NULL,
                            `start` datetime DEFAULT NULL,
                            `end` datetime DEFAULT NULL,
                            PRIMARY KEY (`HRPlanningShiftID`),
                            KEY `department` (`department`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'hr_planning_shift`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'hr_planning_shift_ibfk_1` FOREIGN KEY (`department`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_department` (`business_department_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'hr_planning_staff` (
                            `HRPlanningStaffID` int(11) NOT NULL AUTO_INCREMENT,
                            `person` int(11) DEFAULT NULL,
                            `start` datetime DEFAULT NULL,
                            `end` datetime DEFAULT NULL,
                            `status` tinyint(1) NOT NULL,
                            `type` tinyint(1) NOT NULL,
                            `repeat` tinyint(1) NOT NULL,
                            `rep_interval` tinyint(3) NOT NULL,
                            `rep_monday` tinyint(1) NOT NULL,
                            `rep_tuesday` tinyint(1) NOT NULL,
                            `rep_wednesday` tinyint(1) NOT NULL,
                            `rep_thursday` tinyint(1) NOT NULL,
                            `rep_friday` tinyint(1) NOT NULL,
                            `rep_saturday` tinyint(1) NOT NULL,
                            `rep_sunday` tinyint(1) NOT NULL,
                            PRIMARY KEY (`HRPlanningStaffID`),
                            KEY `person` (`person`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'hr_planning_staff`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'hr_planning_staff_ibfk_1` FOREIGN KEY (`person`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();
                break;
        }
    }
}