<?php
namespace Modules\Billing\Admin;

/**
 * Billing install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Billing
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
     * @param \Framework\DataStorage\Database\Pool $dbPool   Database instance
     * @param array                                    $info Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'billing_invoice` (
                            `billing_invoice_id` int(11) NOT NULL AUTO_INCREMENT,
                            `billing_invoice_status` tinyint(2) DEFAULT NULL,
                            `billing_invoice_shipTo` varchar(50) DEFAULT NULL,
                            `billing_invoice_shipFAO` varchar(30) DEFAULT NULL,
                            `billing_invoice_shipAddr` varchar(50) DEFAULT NULL,
                            `billing_invoice_shipCity` varchar(20) DEFAULT NULL,
                            `billing_invoice_shipZip` varchar(20) DEFAULT NULL,
                            `billing_invoice_shipCountry` varchar(30) DEFAULT NULL,
                            `billing_invoice_billTo` varchar(50) DEFAULT NULL,
                            `billing_invoice_billFAO` varchar(30) DEFAULT NULL,
                            `billing_invoice_billAddr` varchar(50) DEFAULT NULL,
                            `billing_invoice_billCity` varchar(20) DEFAULT NULL,
                            `billing_invoice_billZip` varchar(20) DEFAULT NULL,
                            `billing_invoice_billCountry` varchar(30) DEFAULT NULL,
                            `billing_invoice_type` tinyint(2) DEFAULT NULL,
                            `billing_invoice_created` datetime DEFAULT NULL,
                            `billing_invoice_shippdate` datetime DEFAULT NULL,
                            `billing_invoice_printed` datetime DEFAULT NULL,
                            `billing_invoice_price` decimal(9,2) DEFAULT NULL,
                            `billing_invoice_currency` varchar(3) DEFAULT NULL,
                            `billing_invoice_freightage` decimal(9,2) DEFAULT NULL,
                            `billing_invoice_info` text DEFAULT NULL,
                            `billing_invoice_voucher` int(11) DEFAULT NULL,
                            `billing_invoice_promotion` int(11) DEFAULT NULL,
                            `billing_invoice_creator` int(11) NOT NULL,
                            `billing_invoice_client` int(11) NOT NULL,
                            `billing_invoice_referer` int(11) DEFAULT NULL,
                            `billing_invoice_reference` int(11) DEFAULT NULL,
                            PRIMARY KEY (`billing_invoice_id`),
                            KEY `billing_invoice_creator` (`billing_invoice_creator`),
                            KEY `billing_invoice_client` (`billing_invoice_client`),
                            KEY `billing_invoice_referer` (`billing_invoice_referer`),
                            KEY `billing_invoice_reference` (`billing_invoice_reference`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'billing_invoice`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'billing_invoice_ibfk_1` FOREIGN KEY (`billing_invoice_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'billing_invoice_ibfk_2` FOREIGN KEY (`billing_invoice_client`) REFERENCES `' . $dbPool->get('core')->prefix . 'sales_client` (`sales_client_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'billing_invoice_ibfk_3` FOREIGN KEY (`billing_invoice_referer`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'billing_invoice_ibfk_4` FOREIGN KEY (`billing_invoice_reference`) REFERENCES `' . $dbPool->get('core')->prefix . 'billing_invoice` (`billing_invoice_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'billing_invoice_element` (
                            `billing_invoice_element_id` int(11) NOT NULL AUTO_INCREMENT,
                            `billing_invoice_element_position` smallint(5) NOT NULL,
                            `billing_invoice_element_article` int(11) NOT NULL,
                            `billing_invoice_element_name` varchar(30) NOT NULL,
                            `billing_invoice_element_desc` text NOT NULL,
                            `billing_invoice_element_quantity` int(11) NOT NULL,
                            `billing_invoice_element_price` decimal(11,2) NOT NULL,
                            `billing_invoice_element_tax` decimal(5,2) NOT NULL,
                            `billing_invoice_element_discountp` decimal(5,2) NOT NULL,
                            `billing_invoice_element_discount` decimal(11,2) NOT NULL,
                            `billing_invoice_element_invoice` int(11) NOT NULL,
                            PRIMARY KEY (`billing_invoice_element_id`),
                            KEY `billing_invoice_element_article` (`billing_invoice_element_article`),
                            KEY `billing_invoice_element_invoice` (`billing_invoice_element_invoice`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'billing_invoice_element`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'billing_invoice_element_ibfk_1` FOREIGN KEY (`billing_invoice_element_article`) REFERENCES `' . $dbPool->get('core')->prefix . 'sales_article` (`sales_article_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'billing_invoice_element_ibfk_2` FOREIGN KEY (`billing_invoice_element_invoice`) REFERENCES `' . $dbPool->get('core')->prefix . 'billing_invoice` (`billing_invoice_id`);'
                )->execute();
                break;
        }

        parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
    }
}