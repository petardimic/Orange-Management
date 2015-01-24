<?php
namespace Modules\Billing\Admin;

/**
 * Install warehousing specific tables
 *
 * This only gets executed if the warehousing module is installed
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
class InstallWarehouse extends \Framework\Install\Module
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
                    'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'billing_invoice_element_stock` (
                            `billing_invoice_element_stock_id` int(11) NOT NULL AUTO_INCREMENT,
                            `billing_invoice_element_stock_invoice` int(11) NOT NULL,
                            `billing_invoice_element_stock_stock` int(11) NOT NULL,
                            `billing_invoice_element_stock_quantity` int(11) NOT NULL,
                            PRIMARY KEY (`billing_invoice_element_stock_id`),
                            KEY `billing_invoice_element_stock_invoice` (`billing_invoice_element_stock_invoice`),
                            KEY `billing_invoice_element_stock_stock` (`billing_invoice_element_stock_stock`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $db->con->prepare(
                    'ALTER TABLE `' . $db->prefix . 'billing_invoice_element_stock`
                            ADD CONSTRAINT `' . $db->prefix . 'billing_invoice_element_stock_ibfk_1` FOREIGN KEY (`billing_invoice_element_stock_invoice`) REFERENCES `' . $db->prefix . 'billing_invoice_element` (`billing_invoice_element_id`),
                            ADD CONSTRAINT `' . $db->prefix . 'billing_invoice_element_stock_ibfk_2` FOREIGN KEY (`billing_invoice_element_stock_stock`) REFERENCES `' . $db->prefix . 'warehousing_article_stock` (`warehousing_article_stock_id`);'
                )->execute();

                $db->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'billing_invoice_reserved` (
                            `billing_invoice_reserved_id` int(11) NOT NULL AUTO_INCREMENT,
                            `billing_invoice_reserved_invoice` int(11) NOT NULL,
                            `billing_invoice_reserved_article` int(11) NOT NULL,
                            `billing_invoice_reserved_stock` int(11) DEFAULT NULL,
                            `billing_invoice_reserved_amount` int(11) NOT NULL,
                            `billing_invoice_reserved_active` tinyint(1) NOT NULL,
                            PRIMARY KEY (`billing_invoice_reserved_id`),
                            KEY `billing_invoice_reserved_invoice` (`billing_invoice_reserved_invoice`),
                            KEY `billing_invoice_reserved_stock` (`billing_invoice_reserved_stock`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $db->con->prepare(
                    'ALTER TABLE `' . $db->prefix . 'billing_invoice_reserved`
                            ADD CONSTRAINT `' . $db->prefix . 'billing_invoice_reserved_ibfk_1` FOREIGN KEY (`billing_invoice_reserved_invoice`) REFERENCES `' . $db->prefix . 'billing_invoice_element` (`billing_invoice_elment_id`),
                            ADD CONSTRAINT `' . $db->prefix . 'billing_invoice_reserved_ibfk_2` FOREIGN KEY (`billing_invoice_reserved_stock`) REFERENCES `' . $db->prefix . 'warehousing_article_stock` (`wareousing_article_stock_id`);'
                )->execute();
                break;
        }

        parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
    }
}