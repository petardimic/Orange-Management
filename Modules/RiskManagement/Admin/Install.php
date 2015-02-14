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
class Install extends \phpOMS\Install\Module
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
                            `unit` int(11) NOT NULL,
                            `responsible` int(11) NOT NULL,
                            PRIMARY KEY (`riskmngmt_unit_id`),
                            KEY `unit` (`unit`),
                            KEY `responsible` (`responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_unit`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_unit_ibfk_1` FOREIGN KEY (`unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_unit` (`business_unit_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_unit_ibfk_2` FOREIGN KEY (`responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_department` (
                            `RiskMngmtDepartmentID` int(11) NOT NULL,
                            `department` int(11) NOT NULL,
                            `responsible` int(11) NOT NULL,
                            PRIMARY KEY (`RiskMngmtDepartmentID`),
                            KEY `department` (`department`),
                            KEY `responsible` (`responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_department`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_department_ibfk_1` FOREIGN KEY (`department`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_department` (`business_department_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_department_ibfk_2` FOREIGN KEY (`responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_category` (
                            `RiskMngmtCategoryID` int(11) NOT NULL,
                            `name` varchar(50) NOT NULL,
                            `parent` int(11) DEFAULT NULL,
                            `responsible` int(11) NOT NULL,
                            PRIMARY KEY (`RiskMngmtCategoryID`),
                            KEY `parent` (`parent`),
                            KEY `responsible` (`responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_category`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_category_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_category` (`RiskMngmtCategoryID`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_category_ibfk_2` FOREIGN KEY (`responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                // TODO: more (media, start, end etc...)
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_project` (
                            `RiskMngmtProjectID` int(11) NOT NULL,
                            `name` varchar(50) NOT NULL,
                            `description` text NOT NULL,
                            `unit` int(11) NOT NULL,
                            `responsible` int(11) NOT NULL,
                            PRIMARY KEY (`RiskMngmtProjectID`),
                            KEY `unit` (`unit`),
                            KEY `responsible` (`responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_unit`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_project_ibfk_1` FOREIGN KEY (`unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_unit` (`business_unit_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_project_ibfk_2` FOREIGN KEY (`responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                // TODO: more (media, start, end etc...)
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_process` (
                            `RiskMngmtProcessID` int(11) NOT NULL,
                            `name` varchar(50) NOT NULL,
                            `description` text NOT NULL,
                            `unit` int(11) NOT NULL,
                            `responsible` int(11) NOT NULL,
                            PRIMARY KEY (`RiskMngmtProcessID`),
                            KEY `unit` (`unit`),
                            KEY `responsible` (`responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_unit`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_process_ibfk_1` FOREIGN KEY (`unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_unit` (`business_unit_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_process_ibfk_2` FOREIGN KEY (`responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk` (
                            `RiskMngmtRiskID` int(11) NOT NULL,
                            `name` varchar(50) NOT NULL,
                            `description` text NOT NULL,
                            `unit` int(11) NOT NULL,
                            `deptartment` int(11) NOT NULL,
                            `category` int(11) NOT NULL,
                            `project` int(11) NOT NULL,
                            `process` int(11) NOT NULL,
                            `responsible` int(11) NOT NULL,
                            `backup` int(11) NOT NULL,
                            PRIMARY KEY (`RiskMngmtRiskID`),
                            KEY `unit` (`unit`),
                            KEY `responsible` (`responsible`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_ibfk_1` FOREIGN KEY (`unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_unit` (`business_unit_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_ibfk_2` FOREIGN KEY (`responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_object` (
                            `RiskMngmtRiskObjectID` int(11) NOT NULL,
                            `name` varchar(50) NOT NULL,
                            `risk` int(11) NOT NULL,
                            PRIMARY KEY (`RiskMngmtRiskObjectID`),
                            KEY `risk` (`risk`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_object`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_object_ibfk_1` FOREIGN KEY (`risk`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_risk` (`RiskMngmtRiskID`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_evaluation` (
                            `RiskMngmtRiskEvaluationID` int(11) NOT NULL,
                            `val` decimal(11,4) NOT NULL,
                            `object` int(11) NOT NULL,
                            PRIMARY KEY (`RiskMngmtRiskEvaluationID`),
                            KEY `object` (`object`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_evaluation`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_evaluation_ibfk_1` FOREIGN KEY (`object`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_object` (`RiskMngmtRiskObjectID`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_media` (
                            `RiskMngmtRiskmedia_id` int(11) NOT NULL,
                            `media` int(11) NOT NULL,
                            PRIMARY KEY (`RiskMngmtRiskmedia_id`),
                            KEY `media` (`media`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_media`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_media_ibfk_1` FOREIGN KEY (`media`) REFERENCES `' . $dbPool->get('core')->prefix . 'Media` (`media_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_cause` (
                            `RiskMngmtRiskCauseID` int(11) NOT NULL,
                            `name` varchar(50) NOT NULL,
                            `description` text NOT NULL,
                            `probability` smallint(6) NOT NULL,
                            `deptartment` int(11) NOT NULL,
                            `category` int(11) NOT NULL,
                            `risk` int(11) NOT NULL,
                            PRIMARY KEY (`RiskMngmtRiskCauseID`),
                            KEY `deptartment` (`deptartment`),
                            KEY `category` (`category`),
                            KEY `risk` (`risk`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_cause`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_cause_ibfk_1` FOREIGN KEY (`risk`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_risk` (`RiskMngmtRiskID`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_solution` (
                            `RiskMngmtRiskCauseID` int(11) NOT NULL,
                            `name` varchar(50) NOT NULL,
                            `description` text NOT NULL,
                            `probability` smallint(6) NOT NULL,
                            `effect` decimal(11,4) NOT NULL,
                            `cause` int(11) NOT NULL,
                            `risk` int(11) NOT NULL,
                            PRIMARY KEY (`RiskMngmtRiskCauseID`),
                            KEY `cause` (`cause`),
                            KEY `risk` (`risk`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_solution`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_solution_ibfk_1` FOREIGN KEY (`cause`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_cause` (`RiskMngmtRiskCauseID`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'riskmngmt_risk_solution_ibfk_2` FOREIGN KEY (`risk`) REFERENCES `' . $dbPool->get('core')->prefix . 'riskmngmt_risk` (`RiskMngmtRiskID`);'
                )->execute();
                break;
        }

        parent::installProviding($dbPool, __DIR__ . '/nav.install.json', 'Navigation');
    }
}
