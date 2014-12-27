<?php
namespace Modules\Accounting\Admin {
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_debitor` (
                            `AccountingDebitorID` int(11) NOT NULL AUTO_INCREMENT,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`AccountingDebitorID`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_debitor`
                            ADD CONSTRAINT `accounting_debitor_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'sales_client` (`SalesClientID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_creditor` (
                            `AccountingCreditorID` int(11) NOT NULL AUTO_INCREMENT,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`AccountingCreditorID`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_creditor`
                            ADD CONSTRAINT `accounting_creditor_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'purchase_suppliers` (`PurchaseSupplierID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_account` (
                            `AccountingAccountID` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(25) NOT NULL,
                            `description` varchar(255) NOT NULL,
                            `type` tinyint(1) NOT NULL,
                            `parent` int(11) NOT NULL,
                            PRIMARY KEY (`AccountingAccountID`),
                            KEY `parent` (`parent`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_account`
                            ADD CONSTRAINT `accounting_account_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `' . $db->prefix . 'accounting_account` (`AccountingAccountID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_batch` (
                            `AccountingBatchID` int(11) NOT NULL AUTO_INCREMENT,
                            `title` varchar(30) NOT NULL,
                            `creator` int(11) NOT NULL,
                            `created`datetime NOT NULL,
                            `type` tinyint(1) NOT NULL,
                            PRIMARY KEY (`AccountingBatchID`),
                            KEY `creator` (`creator`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_batch`
                            ADD CONSTRAINT `accounting_batch_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_posting` (
                            `AccountingPostingID` int(11) NOT NULL AUTO_INCREMENT,
                            `batch` int(11) NOT NULL,
                            `receipt` int(11) DEFAULT NULL,
                            `receipt_ext` int(11) DEFAULT NULL,
                            `price` decimal(11,3) NOT NULL,
                            `affiliation` datetime NOT NULL,
                            PRIMARY KEY (`AccountingPostingID`),
                            KEY `batch` (`batch`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_posting`
                            ADD CONSTRAINT `accounting_posting_ibfk_1` FOREIGN KEY (`batch`) REFERENCES `' . $db->prefix . 'accounting_batch` (`AccountingBatchID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_cost_center` (
                            `AccountingCostCenterID` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(25) NOT NULL,
                            `description` varchar(255) NOT NULL,
                            `parent` int(11) NOT NULL,
                            PRIMARY KEY (`AccountingCostCenterID`),
                            KEY `parent` (`parent`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_cost_center`
                            ADD CONSTRAINT `accounting_cost_center_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `' . $db->prefix . 'accounting_cost_center` (`AccountingCostCenterID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_cost_object` (
                            `AccountingCostObjectID` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(25) NOT NULL,
                            `description` varchar(255) NOT NULL,
                            `parent` int(11) NOT NULL,
                            PRIMARY KEY (`AccountingCostObjectID`),
                            KEY `parent` (`parent`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_cost_object`
                            ADD CONSTRAINT `accounting_cost_object_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `' . $db->prefix . 'accounting_cost_object` (`AccountingCostObjectID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_posting_ele` (
                            `AccountingPostingEleID` int(11) NOT NULL AUTO_INCREMENT,
                            `type` tinyint(1) NOT NULL,
                            `account` int(11) NOT NULL,
                            `value` decimal(11,3) NOT NULL,
                            `tax` tinyint(1) NOT NULL,
                            `costcenter` int(11) NOT NULL,
                            `costobject` int(11) NOT NULL,
                            PRIMARY KEY (`AccountingPostingEleID`),
                            KEY `account` (`account`),
                            KEY `costcenter` (`costcenter`),
                            KEY `costobject` (`costobject`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_posting_ele`
                            ADD CONSTRAINT `accounting_posting_ele_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'accounting_account` (`AccountingAccountID`),
                            ADD CONSTRAINT `accounting_posting_ele_ibfk_2` FOREIGN KEY (`costcenter`) REFERENCES `' . $db->prefix . 'accounting_cost_center` (`AccountingCostCenterID`),
                            ADD CONSTRAINT `accounting_posting_ele_ibfk_3` FOREIGN KEY (`costobject`) REFERENCES `' . $db->prefix . 'accounting_cost_object` (`AccountingCostObjectID`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}