<?php
namespace Modules\Purchase\Admin;

/**
 * Purchase install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Purchase
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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'purchase_article` (
                            `purchase_article_id` int(11) NOT NULL AUTO_INCREMENT,
                            `purchase_article_item` int(11) DEFAULT NULL,
                            PRIMARY KEY (`purchase_article_id`),
                            KEY `purchase_article_item` (`purchase_article_item`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'purchase_article`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'purchase_article_ibfk_1` FOREIGN KEY (`purchase_article_item`) REFERENCES `' . $dbPool->get('core')->prefix . 'itemreference` (`itemreference_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'purchase_supplier` (
                            `purchase_supplier_id` int(11) NOT NULL AUTO_INCREMENT,
                            `purchase_supplier_account` int(11) NOT NULL,
                            PRIMARY KEY (`purchase_supplier_id`),
                            KEY `account` (`purchase_supplier_account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'purchase_supplier`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'purchase_supplier_ibfk_1` FOREIGN KEY (`purchase_supplier_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                // TODO: create reference between WE, RG and Order?????
                /* These are the invoices that get created by the purchasing department */
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'purchase_invoice` (
                            `purchase_invoice_id` int(11) NOT NULL AUTO_INCREMENT,
                            `purchase_invoice_status` tinyint(2) DEFAULT NULL,
                            `purchase_invoice_type` tinyint(2) DEFAULT NULL,
                            `purchase_invoice_created` datetime DEFAULT NULL,
                            `purchase_invoice_printed` datetime DEFAULT NULL,
                            `purchase_invoice_price` decimal(9,2) DEFAULT NULL,
                            `purchase_invoice_currency` varchar(3) DEFAULT NULL,
                            `purchase_invoice_creator` int(11) NOT NULL,
                            `purchase_invoice_supplier` int(11) NOT NULL,
                            `purchase_invoice_referer` int(11) NOT NULL,
                            PRIMARY KEY (`purchase_invoice_id`),
                            KEY `purchase_invoice_creator` (`purchase_invoice_creator`),
                            KEY `purchase_invoice_supplier` (`purchase_invoice_supplier`),
                            KEY `purchase_invoice_referer` (`purchase_invoice_referer`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'purchase_invoice`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'purchase_invoice_ibfk_1` FOREIGN KEY (`purchase_invoice_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'purchase_invoice_ibfk_2` FOREIGN KEY (`purchase_invoice_supplier`) REFERENCES `' . $dbPool->get('core')->prefix . 'purchase_supplier` (`purchase_supplier_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'purchase_invoice_ibfk_3` FOREIGN KEY (`purchase_invoice_referer`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();
                break;
        }
    }
}
