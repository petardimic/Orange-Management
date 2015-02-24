<?php
namespace Modules\RiskManagement\Admin;

/**
 * Risk Management install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\RiskManagement
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
     * @param \phpOMS\DataStorage\Database\Pool $dbPool   Database instance
     * @param array                                    $info Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_unit` (
                            `riskmngmt_unit_id` int(11) NOT NULL,
                            `riskmngmt_unit_unit` int(11) NOT NULL,
                            `riskmngmt_unit_responsible` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_unit_id`),
                            KEY `riskmngmt_unit_unit` (`riskmngmt_unit_unit`),
                            KEY `riskmngmt_unit_responsible` (`riskmngmt_unit_responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_unit`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_unit_ibfk_1` FOREIGN KEY (`riskmngmt_unit_unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_unit` (`business_unit_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_unit_ibfk_2` FOREIGN KEY (`riskmngmt_unit_responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_department` (
                            `riskmngmt_department_id` int(11) NOT NULL,
                            `riskmngmt_department_parent` int(11) NOT NULL,
                            `riskmngmt_department_responsible` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_department_id`),
                            KEY `riskmngmt_department_parent` (`riskmngmt_department_parent`),
                            KEY `riskmngmt_department_responsible` (`riskmngmt_department_responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_department`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_department_ibfk_1` FOREIGN KEY (`riskmngmt_department_parent`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_department` (`business_department_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_department_ibfk_2` FOREIGN KEY (`riskmngmt_department_responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_category` (
                            `riskmngmt_category_id` int(11) NOT NULL,
                            `riskmngmt_category_name` varchar(50) NOT NULL,
                            `riskmngmt_category_parent` int(11) DEFAULT NULL,
                            `riskmngmt_category_responsible` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_category_id`),
                            KEY `riskmngmt_category_parent` (`riskmngmt_category_parent`),
                            KEY `riskmngmt_category_responsible` (`riskmngmt_category_responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_category`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_category_ibfk_1` FOREIGN KEY (`riskmngmt_category_parent`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_category` (`riskmngmt_category_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_category_ibfk_2` FOREIGN KEY (`riskmngmt_category_responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                // TODO: more (media, start, end etc...)
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_project` (
                            `riskmngmt_project_id` int(11) NOT NULL,
                            `riskmngmt_project_name` varchar(50) NOT NULL,
                            `riskmngmt_project_description` text NOT NULL,
                            `riskmngmt_project_unit` int(11) NOT NULL,
                            `riskmngmt_project_responsible` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_project_id`),
                            KEY `riskmngmt_project_unit` (`riskmngmt_project_unit`),
                            KEY `riskmngmt_project_responsible` (`riskmngmt_project_responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_project`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_project_ibfk_1` FOREIGN KEY (`riskmngmt_project_unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_unit` (`business_unit_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_project_ibfk_2` FOREIGN KEY (`riskmngmt_project_responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                // TODO: more (media, start, end etc...)
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_process` (
                            `riskmngmt_process_id` int(11) NOT NULL,
                            `riskmngmt_process_name` varchar(50) NOT NULL,
                            `riskmngmt_process_description` text NOT NULL,
                            `riskmngmt_process_unit` int(11) NOT NULL,
                            `riskmngmt_process_responsible` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_process_id`),
                            KEY `riskmngmt_process_unit` (`riskmngmt_process_unit`),
                            KEY `riskmngmt_process_responsible` (`riskmngmt_process_responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_process`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_process_ibfk_1` FOREIGN KEY (`riskmngmt_process_unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_unit` (`business_unit_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_process_ibfk_2` FOREIGN KEY (`riskmngmt_process_responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk` (
                            `riskmngmt_risk_id` int(11) NOT NULL,
                            `riskmngmt_risk_name` varchar(50) NOT NULL,
                            `riskmngmt_risk_description` text NOT NULL,
                            `riskmngmt_risk_unit` int(11) NOT NULL,
                            `riskmngmt_risk_deptartment` int(11) NOT NULL,
                            `riskmngmt_risk_category` int(11) NOT NULL,
                            `riskmngmt_risk_project` int(11) NOT NULL,
                            `riskmngmt_risk_process` int(11) NOT NULL,
                            `riskmngmt_risk_responsible` int(11) NOT NULL,
                            `riskmngmt_risk_backup` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_risk_id`),
                            KEY `riskmngmt_risk_unit` (`riskmngmt_risk_unit`),
                            KEY `riskmngmt_risk_responsible` (`riskmngmt_risk_responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_ibfk_1` FOREIGN KEY (`riskmngmt_risk_unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_unit` (`business_unit_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_ibfk_2` FOREIGN KEY (`riskmngmt_risk_responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_object` (
                            `riskmngmt_risk_object_id` int(11) NOT NULL,
                            `riskmngmt_risk_object_name` varchar(50) NOT NULL,
                            `riskmngmt_risk_object_risk` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_risk_object_id`),
                            KEY `riskmngmt_risk_object_risk` (`riskmngmt_risk_object_risk`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_object`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_object_ibfk_1` FOREIGN KEY (`riskmngmt_risk_object_risk`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_risk` (`riskmngmt_risk_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_eval` (
                            `riskmngmt_risk_eval_id` int(11) NOT NULL,
                            `riskmngmt_risk_eval_val` decimal(11,4) NOT NULL,
                            `riskmngmt_risk_eval_object` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_risk_eval_id`),
                            KEY `riskmngmt_risk_eval_object` (`riskmngmt_risk_eval_object`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_eval`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_evaluation_ibfk_1` FOREIGN KEY (`riskmngmt_risk_eval_object`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_object` (`riskmngmt_risk_object_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_media` (
                            `riskmngmt_risk_media_id` int(11) NOT NULL,
                            `riskmngmt_risk_media_media` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_risk_media_id`),
                            KEY `riskmngmt_risk_media_media` (`riskmngmt_risk_media_media`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_media`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_media_ibfk_1` FOREIGN KEY (`riskmngmt_risk_media_media`) REFERENCES `' . $dbPool->get('core')->prefix . 'media` (`media_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_cause` (
                            `riskmngmt_risk_cause_id` int(11) NOT NULL,
                            `riskmngmt_risk_cause_name` varchar(50) NOT NULL,
                            `riskmngmt_risk_cause_description` text NOT NULL,
                            `riskmngmt_risk_cause_probability` smallint(6) NOT NULL,
                            `riskmngmt_risk_cause_deptartment` int(11) NOT NULL,
                            `riskmngmt_risk_cause_category` int(11) NOT NULL,
                            `riskmngmt_risk_cause_risk` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_risk_cause_id`),
                            KEY `riskmngmt_risk_cause_deptartment` (`riskmngmt_risk_cause_deptartment`),
                            KEY `riskmngmt_risk_cause_category` (`riskmngmt_risk_cause_category`),
                            KEY `riskmngmt_risk_cause_risk` (`riskmngmt_risk_cause_risk`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_cause`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_cause_ibfk_1` FOREIGN KEY (`riskmngmt_risk_cause_risk`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_risk` (`riskmngmt_risk_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_solution` (
                            `riskmngmt_risk_solution_id` int(11) NOT NULL,
                            `riskmngmt_risk_solution_name` varchar(50) NOT NULL,
                            `riskmngmt_risk_solution_description` text NOT NULL,
                            `riskmngmt_risk_solution_probability` smallint(6) NOT NULL,
                            `riskmngmt_risk_solution_effect` decimal(11,4) NOT NULL,
                            `riskmngmt_risk_solution_cause` int(11) NOT NULL,
                            `riskmngmt_risk_solution_risk` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_risk_solution_id`),
                            KEY `riskmngmt_risk_solution_cause` (`riskmngmt_risk_solution_cause`),
                            KEY `riskmngmt_risk_solution_risk` (`riskmngmt_risk_solution_risk`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_solution`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_solution_ibfk_1` FOREIGN KEY (`riskmngmt_risk_solution_cause`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_cause` (`riskmngmt_risk_cause_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_solution_ibfk_2` FOREIGN KEY (`riskmngmt_risk_solution_risk`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_risk` (`riskmngmt_risk_id`);'
                )->execute();
                break;
        }
    }
}
