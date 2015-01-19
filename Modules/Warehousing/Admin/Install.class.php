<?php
namespace Modules\Warehousing\Admin {
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'warehousing_stock` (
                            `WarehousingStockID` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(50) DEFAULT NULL,
                            PRIMARY KEY (`WarehousingStockID`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'warehousing_stock_location` (
                            `WarehousingStockLocationID` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(50) DEFAULT NULL,
                            `stock` int(11) DEFAULT NULL,
                            PRIMARY KEY (`WarehousingStockLocationID`),
                            KEY `stock` (`stock`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'warehousing_stock_location`
                            ADD CONSTRAINT `warehousing_stock_location_ibfk_1` FOREIGN KEY (`stock`) REFERENCES `' . $db->prefix . 'warehousing_stock` (`WarehousingStockID`);'
                    )->execute();

                    // TODO: complete
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'warehousing_article` (
                            `WarehousingArticleID` int(11) NOT NULL AUTO_INCREMENT,
                            `weight` int(11) DEFAULT NULL,
                            `dimension` varchar(17) DEFAULT NULL,
                            `volume` int(11) DEFAULT NULL,
                            `lot` tinyint(1) DEFAULT NULL,
                            `status` tinyint(2) DEFAULT NULL,
                            PRIMARY KEY (`WarehousingArticleID`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'warehousing_article_disposal` (
                            `WarehousingArticleID` int(11) NOT NULL AUTO_INCREMENT,
                            `glas` int(11) DEFAULT NULL,
                            `paper` int(11) DEFAULT NULL,
                            `sheet` int(11) DEFAULT NULL,
                            `aluminium` int(11) DEFAULT NULL,
                            `synthetic` int(11) DEFAULT NULL,
                            `cardboard` int(11) DEFAULT NULL,
                            `composites` int(11) DEFAULT NULL,
                            `organic` int(11) DEFAULT NULL,
                            `pe` int(11) DEFAULT NULL,
                            `misc` int(11) DEFAULT NULL,
                            PRIMARY KEY (`WarehousingArticleID`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'warehousing_arrival` (
                            `WarehousingArrivalID` int(11) NOT NULL AUTO_INCREMENT,
                            `arrivaldate` datetime DEFAULT NULL,
                            `supplier` int(11) DEFAULT NULL,
                            `media` int(11) DEFAULT NULL,
                            `pcondition` tinyint(1) DEFAULT NULL,
                            `acondition` tinyint(1) DEFAULT NULL,
                            `amount` tinyint(1) DEFAULT NULL,
                            `checked` int(11) DEFAULT NULL,
                            PRIMARY KEY (`WarehousingArrivalID`),
                            KEY `supplier` (`supplier`),
                            KEY `checked` (`checked`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'warehousing_arrival`
                            ADD CONSTRAINT `warehousing_arrival_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `' . $db->prefix . 'purchase_suppliers` (`id`),
                            ADD CONSTRAINT `warehousing_arrival_ibfk_2` FOREIGN KEY (`checked`) REFERENCES `' . $db->prefix . 'account` (`id`);'
                    )->execute();

                    /* info: amount will get increased and reduced based on invoices -> will result in a high amount of entries where the amount is 0 -> long lookup times for available lot lookup?! */
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'warehousing_article_stock` (
                            `WarehousingArticleStockID` int(11) NOT NULL AUTO_INCREMENT,
                            `article` int(11) DEFAULT NULL,
                            `lot` varchar(256) DEFAULT NULL,
                            `sn` varchar(256) DEFAULT NULL,
                            `durability` datetime DEFAULT NULL,
                            `arrival` int(11) DEFAULT NULL,
                            `amount` mediumint(9) DEFAULT NULL,
                            `location` int(11) DEFAULT NULL,
                            PRIMARY KEY (`WarehousingArticleStockID`),
                            KEY `article` (`article`),
                            KEY `arrival` (`arrival`),
                            KEY `location` (`location`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'warehousing_stock_sublocation`
                            ADD CONSTRAINT `warehousing_article_stock_ibfk_1` FOREIGN KEY (`article`) REFERENCES `' . $db->prefix . 'warehousing_article` (`WarehousingArticleID`),
                            ADD CONSTRAINT `warehousing_article_stock_ibfk_2` FOREIGN KEY (`arrival`) REFERENCES `' . $db->prefix . 'warehousing_arrival` (`WarehousingArrivalID`),
                            ADD CONSTRAINT `warehousing_article_stock_ibfk_3` FOREIGN KEY (`location`) REFERENCES `' . $db->prefix . 'warehousing_stock_location` (`WarehousingStockLocationID`);'
                    )->execute();

                    // TODO: maybe consider chaning shipCountry varchar to size 55 (based on ISO 3166-1) (same goes for sales department tables)
                    // TODO: create shipFrom table = business address of your company (maybe multiple)
                    // TODO: implement ups fields make sure to use multiple tables (multiple packages)
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'warehousing_shipping` (
                            `WarehousingShippingID` int(11) NOT NULL AUTO_INCREMENT,
                            `shippingdate` datetime DEFAULT NULL,
                            `shipTo` varchar(50) DEFAULT NULL,
                            `shipFAO` varchar(30) DEFAULT NULL,
                            `shipAddr` varchar(50) DEFAULT NULL,
                            `shipCity` varchar(20) DEFAULT NULL,
                            `shipState` varchar(30) DEFAULT NULL,
                            `shipZip` varchar(20) DEFAULT NULL,
                            `shipCountry` varchar(30) DEFAULT NULL,
                            `shipPhone` varchar(30) DEFAULT NULL,
                            `shipFrom` int(11) DEFAULT NULL,
                            `carrier` varchar(30) DEFAULT NULL,
                            `tracking` varchar(7089) DEFAULT NULL,
                            `client` int(11) DEFAULT NULL,
                            `invoice` int(11) DEFAULT NULL,
                            `shipped` int(11) DEFAULT NULL,
                            PRIMARY KEY (`WarehousingShippingID`),
                            KEY `shipped` (`shipped`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'warehousing_shipping`
                            ADD CONSTRAINT `warehousing_shipping_ibfk_1` FOREIGN KEY (`shipped`) REFERENCES `' . $db->prefix . 'account` (`id`);'
                    )->execute();

                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}