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
                            ADD CONSTRAINT `' . $db->prefix . 'purchase_suppliers_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                    )->execute();

                    // TODO: create reference between WE, RG and Order?????
                    /* These are the invoices that get created by the purchasing department */
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
                            ADD CONSTRAINT `' . $db->prefix . 'purchase_invoices_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $db->prefix . 'purchase_invoices_ibfk_2` FOREIGN KEY (`supplier`) REFERENCES `' . $db->prefix . 'purchase_suppliers` (`PurchaseSupplierID`),
                            ADD CONSTRAINT `' . $db->prefix . 'purchase_invoices_ibfk_3` FOREIGN KEY (`referer`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                    )->execute();

                    /* status - maybe something like already checked or no one from purchasing has seen this */
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'purchase_dnote` (
                            `PurchaseDnoteID` int(11) NOT NULL AUTO_INCREMENT,
                            `status` tinyint(1) DEFAULT NULL,
                            `media` int(11) DEFAULT NULL,
                            `supplier` int(11) DEFAULT NULL,
                            `sname` varchar(32) DEFAULT NULL,
                            `optained` datetime NOT NULL,
                            `invoicedate` datetime NOT NULL,
                            `internalref` int(11) NOT NULL,
                            PRIMARY KEY (`PurchaseDnoteID`),
                            KEY `media` (`media`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'purchase_dnote`
                            ADD CONSTRAINT `' . $db->prefix . 'purchase_dnote_ibfk_1` FOREIGN KEY (`media`) REFERENCES `' . $db->prefix . 'media` (`media_id`);'
                    )->execute();

                    // TODO: FIX THIS AT least check if exists
                    // TODO: move to extra install script
/*
                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'warehousing_arrival`
                            ADD CONSTRAINT `' . $db->prefix . 'warehousing_arrival_ibfk_2` FOREIGN KEY (`dnote`) REFERENCES `' . $db->prefix . 'purchase_dnote` (`PurchaseDnoteID`);'
                    )->execute();*/
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}