<?php
namespace Modules\Sales\Admin;

/**
 * Sales install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Sales
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
                    'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_client` (
                            `sales_client_id` int(11) NOT NULL AUTO_INCREMENT,
                            `sales_client_matchcode` varchar(50) DEFAULT NULL,
                            `sales_client_account` int(11) NOT NULL,
                            PRIMARY KEY (`sales_client_id`),
                            KEY `sales_client_account` (`sales_client_account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $db->con->prepare(
                    'ALTER TABLE `' . $db->prefix . 'sales_client`
                            ADD CONSTRAINT `' . $db->prefix . 'sales_client_ibfk_1` FOREIGN KEY (`sales_client_account`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                )->execute();

                $db->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_article` (
                            `sales_article_id` int(11) NOT NULL AUTO_INCREMENT,
                            `sales_article_class` tinyint(3) DEFAULT NULL,
                            `sales_article_group` tinyint(3) DEFAULT NULL,
                            `sales_article_subgroup` tinyint(3) DEFAULT NULL,
                            `sales_article_item` int(11) DEFAULT NULL,
                            PRIMARY KEY (`sales_article_id`),
                            KEY `sales_article_item` (`sales_article_item`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $db->con->prepare(
                    'ALTER TABLE `' . $db->prefix . 'sales_article`
                            ADD CONSTRAINT `' . $db->prefix . 'sales_article_ibfk_1` FOREIGN KEY (`sales_article_item`) REFERENCES `' . $db->prefix . 'itemreference` (`itemreference_id`);'
                )->execute();

                $db->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_article_class` (
                            `sales_article_class_id` int(11) NOT NULL AUTO_INCREMENT,
                            `sales_article_class_type` tinyint(1) DEFAULT NULL,
                            `sales_article_class_name` varchar(50) DEFAULT NULL,
                            `sales_article_class_desc` varchar(250) DEFAULT NULL,
                            `sales_article_class_parent` int(11) DEFAULT NULL,
                            PRIMARY KEY (`sales_article_class_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $db->con->prepare(
                    'ALTER TABLE `' . $db->prefix . 'sales_article_class`
                            ADD CONSTRAINT `' . $db->prefix . 'sales_article_class_ibfk_1` FOREIGN KEY (`sales_article_class_parent`) REFERENCES `' . $db->prefix . 'sales_article_class` (`sales_article_class_id`);'
                )->execute();

                $db->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_article_desc` (
                            `sales_article_desc_id` int(11) NOT NULL AUTO_INCREMENT,
                            `sales_article_desc_name1` varchar(50) DEFAULT NULL,
                            `sales_article_desc_name2` varchar(50) DEFAULT NULL,
                            `sales_article_desc_desc` varchar(250) DEFAULT NULL,
                            `sales_article_desc_lang` varchar(2) DEFAULT NULL,
                            `sales_article_desc_article` int(11) NOT NULL,
                            PRIMARY KEY (`sales_article_desc_id`),
                            KEY `sales_article_desc_article` (`sales_article_desc_article`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $db->con->prepare(
                    'ALTER TABLE `' . $db->prefix . 'sales_article_desc`
                            ADD CONSTRAINT `' . $db->prefix . 'sales_article_desc_ibfk_1` FOREIGN KEY (`sales_article_desc_article`) REFERENCES `' . $db->prefix . 'sales_article` (`sales_article_id`);'
                )->execute();

                $db->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_article_price` (
                            `sales_article_price_id` int(11) NOT NULL AUTO_INCREMENT,
                            `sales_article_price_type` tinyint(2) NOT NULL,
                            `sales_article_price_default` tinyint(1) NOT NULL,
                            `sales_article_price_price` decimal(9, 2) DEFAULT NULL,
                            `sales_article_price_discountp` decimal(5, 2) DEFAULT NULL,
                            `sales_article_price_discount` decimal(9, 2) DEFAULT NULL,
                            `sales_article_price_mprice` decimal(9, 2) DEFAULT NULL,
                            `sales_article_price_article` int(11) NOT NULL,
                            PRIMARY KEY (`sales_article_price_id`),
                            KEY `sales_article_price_article` (`sales_article_price_article`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $db->con->prepare(
                    'ALTER TABLE `' . $db->prefix . 'sales_article_price`
                            ADD CONSTRAINT `' . $db->prefix . 'sales_article_price_ibfk_1` FOREIGN KEY (`sales_article_price_article`) REFERENCES `' . $db->prefix . 'sales_article` (`sales_article_id`);'
                )->execute();
                break;
        }

        parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
    }
}