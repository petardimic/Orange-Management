<?php
namespace Modules\Accounting\Admin;
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
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_account_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `' . $db->prefix . 'accounting_account` (`AccountingAccountID`);'
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
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_batch_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
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
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_posting_ibfk_1` FOREIGN KEY (`batch`) REFERENCES `' . $db->prefix . 'accounting_batch` (`AccountingBatchID`);'
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
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_cost_center_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `' . $db->prefix . 'accounting_cost_center` (`AccountingCostCenterID`);'
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
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_cost_object_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `' . $db->prefix . 'accounting_cost_object` (`AccountingCostObjectID`);'
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
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_posting_ele_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'accounting_account` (`AccountingAccountID`),
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_posting_ele_ibfk_2` FOREIGN KEY (`costcenter`) REFERENCES `' . $db->prefix . 'accounting_cost_center` (`AccountingCostCenterID`),
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_posting_ele_ibfk_3` FOREIGN KEY (`costobject`) REFERENCES `' . $db->prefix . 'accounting_cost_object` (`AccountingCostObjectID`);'
                    )->execute();

                    /*
                     * type = (offer, confirmation etc.)
                     * soptained = date of when we received the service/order (not the invoice)
                     * check = person who checked or is supposed to check the invoice
                     * checked = date of when the invoice got approved (no datetime = no approval)
                     * posting referes (direct)
                     * payment referes to this (indirect)
                     * status {
                     *  blank
                     *  received-ok
                     *  received-notok
                     *  checked-ok
                     *  checked-notok
                     *  posted-ok
                     *  posted-notok
                     *  payed-ok
                     *  payed-notok
                     * }
                     */
                    /*
                     * TODO: Purchasing can create. person who creates automatically get's permission for these to read.
                     * TODO: move to different module
                     */
                    /*
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_invoices_process` (
                            `AccountingInvoiceProcessID` int(11) NOT NULL AUTO_INCREMENT,
                            `media` int(11) DEFAULT NULL,
                            `type` tinyint(1) DEFAULT NULL,
                            `supplier` int(11) DEFAULT NULL,
                            `sname` varchar(32) DEFAULT NULL,
                            `optained` datetime NOT NULL,
                            `soptained` datetime NOT NULL,
                            `refnumber` varchar(24) NOT NULL,
                            `invoicedate` datetime NOT NULL,
                            `internalref` int(11) NOT NULL,
                            `due` datetime NOT NULL,
                            `duediscount` datetime NOT NULL,
                            `amount` decimal(11,3) NOT NULL,
                            `amountdiscount` decimal(11,3) NOT NULL,
                            `order` int(11) DEFAULT NULL,
                            `arrival` int(11) DEFAULT NULL,
                            `dnote` int(11) DEFAULT NULL,
                            PRIMARY KEY (`AccountingInvoiceProcessID`),
                            KEY `media` (`media`),
                            KEY `order` (`order`),
                            KEY `arrival` (`arrival`),
                            KEY `dnote` (`dnote`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_invoices_process`
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_invoices_process_ibfk_1` FOREIGN KEY (`media`) REFERENCES `' . $db->prefix . 'media` (`media_id`),
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_invoices_process_ibfk_2` FOREIGN KEY (`order`) REFERENCES `' . $db->prefix . 'purchase_invoices` (`PurchaseInvoiceID`),
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_invoices_process_ibfk_3` FOREIGN KEY (`arrival`) REFERENCES `' . $db->prefix . 'warehousing_arrival` (`WarehousingArrivalID`),
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_invoices_process_ibfk_4` FOREIGN KEY (`dnote`) REFERENCES `' . $db->prefix . 'purchase_dnote` (`PurchaseDnoteID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_invoices_status` (
                            `AccountingInvoiceStatusID` int(11) NOT NULL AUTO_INCREMENT,
                            `invoice` int(11) DEFAULT NULL,
                            `status` tinyint(1) DEFAULT NULL,
                            `person` int(11) DEFAULT NULL,
                            `changed` datetime DEFAULT NULL,
                            `info` varchar(256) NOT NULL,
                            PRIMARY KEY (`AccountingInvoiceStatusID`),
                            KEY `invoice` (`invoice`),
                            KEY `person` (`person`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_invoices_status`
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_invoices_status_ibfk_1` FOREIGN KEY (`invoice`) REFERENCES `' . $db->prefix . 'accounting_invoices_process` (`AccountingInvoiceProcessID`),
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_invoices_status_ibfk_2` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_invoices_process_permission` (
                            `AccountingInvoiceProcessPermissionID` int(11) NOT NULL AUTO_INCREMENT,
                            `process` int(11) DEFAULT NULL,
                            `person` int(11) DEFAULT NULL,
                            `permission` int(11) DEFAULT NULL,
                            PRIMARY KEY (`AccountingInvoiceProcessPermissionID`),
                            KEY `person` (`person`),
                            KEY `process` (`process`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_invoices_process_permission`
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_invoices_process_permission_ibfk_1` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $db->prefix . 'accounting_invoices_process_permission_ibfk_2` FOREIGN KEY (`process`) REFERENCES `' . $db->prefix . 'accounting_invoices_process` (`AccountingInvoiceProcessID`);'
                    )->execute();*/
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }