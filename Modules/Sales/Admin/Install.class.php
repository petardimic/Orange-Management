<?php
namespace Modules\Sales\Admin {
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_client` (
                            `SalesClientID` int(11) NOT NULL AUTO_INCREMENT,
                            `matchcode` varchar(50) DEFAULT NULL,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`SalesClientID`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'sales_client`
                            ADD CONSTRAINT `sales_client_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_articles` (
                            `SalesArticleID` int(11) NOT NULL AUTO_INCREMENT,
                            `class` tinyint(3) DEFAULT NULL,
                            `group` tinyint(3) DEFAULT NULL,
                            `subgroup` tinyint(3) DEFAULT NULL,
                            `article` int(11) DEFAULT NULL,
                            PRIMARY KEY (`SalesArticleID`),
                            KEY `article` (`article`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    /* TODO: remember to give warehousing articles a name as well! */

                    /*$db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'sales_articles`
                            ADD CONSTRAINT `sales_articles_ibfk_1` FOREIGN KEY (`article`) REFERENCES `' . $db->prefix . 'stock_articles` (`id`);'
                    )->execute();*/

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_articles_single` (
                            `SalesArticleID` int(11) NOT NULL AUTO_INCREMENT,
                            `type` tinyint(1) DEFAULT NULL,
                            `lot` varchar(30) DEFAULT NULL,
                            `lotext` varchar(30) DEFAULT NULL,
                            `created` datetime DEFAULT NULL,
                            `durability` datetime DEFAULT NULL,
                            `checked` int(11) DEFAULT NULL,
                            `status` tinyint(1) DEFAULT NULL,
                            `inspected` datetime DEFAULT NULL,
                            `stock` int(11) DEFAULT NULL,
                            `location` int(11) DEFAULT NULL,
                            `amount` int(11) DEFAULT NULL,
                            `article` int(11) DEFAULT NULL,
                            PRIMARY KEY (`SalesArticleID`),
                            KEY `article` (`article`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'sales_articles_single`
                            ADD CONSTRAINT `sales_articles_single_ibfk_1` FOREIGN KEY (`article`) REFERENCES `' . $db->prefix . 'sales_articles` (`SalesArticleID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_articles_classification` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `type` tinyint(1) DEFAULT NULL,
                            `name` varchar(50) DEFAULT NULL,
                            `desc` varchar(250) DEFAULT NULL,
                            `parent` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'sales_articles_classification`
                            ADD CONSTRAINT `sales_articles_classification_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `' . $db->prefix . 'sales_articles_classification` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_articles_desc` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `name1` varchar(50) DEFAULT NULL,
                            `name2` varchar(50) DEFAULT NULL,
                            `desc` varchar(250) DEFAULT NULL,
                            `lang` varchar(2) DEFAULT NULL,
                            `article` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `article` (`article`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'sales_articles_desc`
                            ADD CONSTRAINT `sales_articles_desc_ibfk_1` FOREIGN KEY (`article`) REFERENCES `' . $db->prefix . 'sales_articles` (`SalesArticleID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_articles_prices` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `type` tinyint(2) NOT NULL,
                            `default` tinyint(1) NOT NULL,
                            `price` decimal(9, 2) DEFAULT NULL,
                            `discountp` decimal(5, 2) DEFAULT NULL,
                            `discount` decimal(9, 2) DEFAULT NULL,
                            `mprice` decimal(9, 2) DEFAULT NULL,
                            `article` int(11) NOT NULL,
                            PRIMARY KEY (`id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'sales_articles_prices`
                            ADD CONSTRAINT `sales_articles_prices_ibfk_1` FOREIGN KEY (`article`) REFERENCES `' . $db->prefix . 'sales_articles` (`SalesArticleID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_invoices` (
                            `SalesInvoiceID` int(11) NOT NULL AUTO_INCREMENT,
                            `status` tinyint(2) DEFAULT NULL,
                            `type` tinyint(2) DEFAULT NULL,
                            `created` datetime DEFAULT NULL,
                            `printed` datetime DEFAULT NULL,
                            `price` decimal(9,2) DEFAULT NULL,
                            `currency` varchar(3) DEFAULT NULL,
                            `creator` int(11) NOT NULL,
                            `client` int(11) NOT NULL,
                            `referer` int(11) NOT NULL,
                            PRIMARY KEY (`SalesInvoiceID`),
                            KEY `creator` (`creator`),
                            KEY `client` (`client`),
                            KEY `referer` (`referer`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'sales_invoices`
                            ADD CONSTRAINT `sales_invoices_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'accounts` (`id`),
                            ADD CONSTRAINT `sales_invoices_ibfk_2` FOREIGN KEY (`client`) REFERENCES `' . $db->prefix . 'sales_client` (`SalesClientID`),
                            ADD CONSTRAINT `sales_invoices_ibfk_3` FOREIGN KEY (`referer`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}