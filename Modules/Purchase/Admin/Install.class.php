<?php
namespace Modules\Purchase\Admin {
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'purchase_articles` (
                            `PurchaseArticleID` int(11) NOT NULL AUTO_INCREMENT,
                            `article` int(11) DEFAULT NULL,
                            PRIMARY KEY (`PurchaseArticleID`),
                            KEY `article` (`article`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    /* TODO: add constraint */

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'purchase_suppliers` (
                            `PurchaseSupplierID` int(11) NOT NULL AUTO_INCREMENT,
                            `matchcode` varchar(50) DEFAULT NULL,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`PurchaseSupplierID`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'purchase_suppliers`
                            ADD CONSTRAINT `purchase_suppliers_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'purchase_invoices` (
                            `PurchaseInvoiceID` int(11) NOT NULL AUTO_INCREMENT,
                            `status` tinyint(2) DEFAULT NULL,
                            `type` tinyint(2) DEFAULT NULL,
                            `created` datetime DEFAULT NULL,
                            `printed` datetime DEFAULT NULL,
                            `price` decimal(9,2) DEFAULT NULL,
                            `currency` varchar(3) DEFAULT NULL,
                            `creator` int(11) NOT NULL,
                            `supplier` int(11) NOT NULL,
                            `referer` int(11) NOT NULL,
                            PRIMARY KEY (`PurchaseInvoiceID`),
                            KEY `creator` (`creator`),
                            KEY `supplier` (`supplier`),
                            KEY `referer` (`referer`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'purchase_invoices`
                            ADD CONSTRAINT `purchase_invoices_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'accounts` (`id`),
                            ADD CONSTRAINT `purchase_invoices_ibfk_2` FOREIGN KEY (`supplier`) REFERENCES `' . $db->prefix . 'purchase_suppliers` (`PurchaseSupplierID`),
                            ADD CONSTRAINT `purchase_invoices_ibfk_3` FOREIGN KEY (`referer`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
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
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'purchase_invoices_process` (
                            `PurchaseInvoiceProcessID` int(11) NOT NULL AUTO_INCREMENT,
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
                            PRIMARY KEY (`PurchaseInvoiceProcessID`),
                            KEY `media` (`media`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'purchase_invoices_process`
                            ADD CONSTRAINT `purchase_invoices_process_ibfk_1` FOREIGN KEY (`media`) REFERENCES `' . $db->prefix . 'media` (`MediaID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'purchase_invoices_status` (
                            `PurchaseInvoiceStatusID` int(11) NOT NULL AUTO_INCREMENT,
                            `invoice` int(11) DEFAULT NULL,
                            `status` tinyint(1) DEFAULT NULL,
                            `person` int(11) DEFAULT NULL,
                            `changed` datetime DEFAULT NULL,
                            `info` varchar(256) NOT NULL,
                            PRIMARY KEY (`PurchaseInvoiceStatusID`),
                            KEY `invoice` (`invoice`),
                            KEY `person` (`person`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'purchase_invoices_status`
                            ADD CONSTRAINT `purchase_invoices_status_ibfk_1` FOREIGN KEY (`invoice`) REFERENCES `' . $db->prefix . 'purchase_invoices_process` (`PurchaseInvoiceProcessID`),
                            ADD CONSTRAINT `purchase_invoices_status_ibfk_2` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'purchase_invoices_process_permission` (
                            `PurchaseInvoiceProcessPermissionID` int(11) NOT NULL AUTO_INCREMENT,
                            `process` int(11) DEFAULT NULL,
                            `person` int(11) DEFAULT NULL,
                            `permission` int(11) DEFAULT NULL,
                            PRIMARY KEY (`PurchaseInvoiceProcessPermissionID`),
                            KEY `person` (`person`),
                            KEY `process` (`process`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'purchase_invoices_process_permission`
                            ADD CONSTRAINT `purchase_invoices_process_permission_ibfk_1` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'accounts` (`id`),
                            ADD CONSTRAINT `purchase_invoices_process_permission_ibfk_2` FOREIGN KEY (`process`) REFERENCES `' . $db->prefix . 'purchase_invoices_process` (`PurchaseInvoiceProcessID`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}