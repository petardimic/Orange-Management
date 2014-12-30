<?php
namespace Modules\HumanResources\Admin {
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'hr_department` (
                            `HRDepartmentID` int(11) NOT NULL AUTO_INCREMENT,
                            `name`  varchar(30) NOT NULL,
                            `parent` int(11) DEFAULT NULL,
                            PRIMARY KEY (`HRDepartmentID`),
                            KEY `parent` (`parent`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'hr_department`
                            ADD CONSTRAINT `hr_department_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `' . $db->prefix . 'hr_department` (`HRDepartmentID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'hr_staff` (
                            `HRStaffID` int(11) NOT NULL AUTO_INCREMENT,
                            `status` tinyint(2) DEFAULT NULL,
                            `person` int(11) DEFAULT NULL,
                            PRIMARY KEY (`HRStaffID`),
                            KEY `person` (`person`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'hr_staff`
                            ADD CONSTRAINT `hr_staff_ibfk_1` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'hr_staff_history` (
                            `HRStaffHistID` int(11) NOT NULL AUTO_INCREMENT,
                            `staff` int(11) DEFAULT NULL,
                            `position` int(11) DEFAULT NULL,
                            `department` int(11) DEFAULT NULL,
                            `start` datetime DEFAULT NULL,
                            `end` datetime DEFAULT NULL,
                            PRIMARY KEY (`HRStaffHistID`),
                            KEY `staff` (`staff`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'hr_staff_history`
                            ADD CONSTRAINT `hr_staff_history_ibfk_1` FOREIGN KEY (`staff`) REFERENCES `' . $db->prefix . 'hr_staff` (`HRStaffID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'hr_staff_contract` (
                            `HRStaffContractID` int(11) NOT NULL AUTO_INCREMENT,
                            `stype` tinyint(1) DEFAULT NULL,
                            `salary` decimal(8,2) DEFAULT NULL,
                            `cformingbenefits` decimal(8,2) DEFAULT NULL,
                            `working_hours` int(11) DEFAULT NULL,
                            `vacation` tinyint(3) DEFAULT NULL,
                            `vtype` tinyint(3) DEFAULT NULL,
                            `personal_time` tinyint(3) DEFAULT NULL,
                            `start` datetime DEFAULT NULL,
                            `end` datetime DEFAULT NULL,
                            `person` int(11) DEFAULT NULL,
                            PRIMARY KEY (`HRStaffContractID`),
                            KEY `person` (`person`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'hr_staff_contract`
                            ADD CONSTRAINT `hr_staff_contract_ibfk_1` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'hr_planning_shift` (
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

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'hr_planning_shift`
                            ADD CONSTRAINT `hr_planning_shift_ibfk_1` FOREIGN KEY (`department`) REFERENCES `' . $db->prefix . 'hr_department` (`HRDepartmentID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'hr_planning_staff` (
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

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'hr_planning_staff`
                            ADD CONSTRAINT `hr_planning_staff_ibfk_1` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'hr_staff_clocking` (
                            `HRStaffClockingID` int(11) NOT NULL AUTO_INCREMENT,
                            `person` int(11) DEFAULT NULL,
                            `start` datetime DEFAULT NULL,
                            `end` datetime DEFAULT NULL,
                            `type` tinyint(1) NOT NULL,
                            PRIMARY KEY (`HRStaffClockingID`),
                            KEY `person` (`person`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'hr_staff_clocking`
                            ADD CONSTRAINT `hr_staff_clocking_ibfk_1` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'hr_staff_payroll` (
                            `HRStaffCPayrollID` int(11) NOT NULL AUTO_INCREMENT,
                            `person` int(11) DEFAULT NULL,
                            `reference` int(11) DEFAULT NULL,
                            `start` datetime DEFAULT NULL,
                            `end` datetime DEFAULT NULL,
                            `type` tinyint(1) NOT NULL,
                            `amount` decimal(11,2) NOT NULL,
                            PRIMARY KEY (`HRStaffClockingID`),
                            KEY `person` (`person`),
                            KEY `reference` (`reference`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'hr_staff_payroll`
                            ADD CONSTRAINT `hr_staff_payroll_ibfk_1` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'accounts` (`id`),
                            ADD CONSTRAINT `hr_staff_payroll_ibfk_2` FOREIGN KEY (`reference`) REFERENCES `' . $db->prefix . 'hr_staff_payroll` (`HRStaffCPayrollID`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}