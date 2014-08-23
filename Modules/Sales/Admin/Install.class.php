<?php
namespace Modules\Sales\Admin {
    /**
     * Navigation class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Install extends \Framework\Install\Module {
        /**
         * Install module
         *
         * @param \Framework\DataStorage\Database\Database $db   Database instance
         * @param array                                    $info Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install(&$db, $info) {
            switch ($db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'clients` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `matchcode` varchar(50) DEFAULT NULL,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'clients`
                            ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_articles` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `matchcode` varchar(50) DEFAULT NULL,
                            `class` tinyint(3) DEFAULT NULL,
                            `group` tinyint(3) DEFAULT NULL,
                            `subgroup` tinyint(3) DEFAULT NULL,
                            PRIMARY KEY (`id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
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
                            ADD CONSTRAINT `sales_articles_desc_ibfk_1` FOREIGN KEY (`article`) REFERENCES `' . $db->prefix . 'sales_articles` (`id`);'
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
                            ADD CONSTRAINT `sales_articles_prices_ibfk_1` FOREIGN KEY (`article`) REFERENCES `' . $db->prefix . 'sales_articles` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'sales_invoices` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `created` datetime DEFAULT NULL,
                            `price` decimal(9,2) DEFAULT NULL,
                            `currency` varchar(3) DEFAULT NULL,
                            `creator` int(11) NOT NULL,
                            `client` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `creator` (`creator`, `client`),
                            KEY `client` (`client`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'sales_invoices`
                            ADD CONSTRAINT `sales_invoices_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'accounts` (`id`),
                            ADD CONSTRAINT `sales_invoices_ibfk_2` FOREIGN KEY (`client`) REFERENCES `' . $db->prefix . 'clients` (`id`);'
                    )->execute();
                    break;
            }

            parent::install_providing($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}