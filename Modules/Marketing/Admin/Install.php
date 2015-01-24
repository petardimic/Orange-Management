<?php
namespace Modules\Marketing\Admin {
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'marketing_promotion` (
                            `MarketingPromotionID` int(11) NOT NULL AUTO_INCREMENT,
                            `name`  varchar(30) NOT NULL,
                            `description` text DEFAULT NULL,
                            `start` datetime DEFAULT NULL,
                            `end` datetime DEFAULT NULL,
                            `type` tinyint(1) DEFAULT NULL,
                            PRIMARY KEY (`MarketingPromotionID`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'marketing_promotion_client` (
                            `MarketingPromotionClientID` int(11) NOT NULL AUTO_INCREMENT,
                            `promotion` int(11) DEFAULT NULL,
                            `invoice` int(11) DEFAULT NULL,
                            `client` int(11) DEFAULT NULL,
                            PRIMARY KEY (`MarketingPromotionClientID`),
                            KEY `promotion` (`promotion`),
                            KEY `client` (`client`),
                            KEY `invoice` (`invoice`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'marketing_promotion_client`
                            ADD CONSTRAINT `marketing_promotion_client_ibfk_1` FOREIGN KEY (`promotion`) REFERENCES `' . $db->prefix . 'marketing_promotion` (`MarketingPromotionID`),
                            ADD CONSTRAINT `marketing_promotion_client_ibfk_2` FOREIGN KEY (`client`) REFERENCES `' . $db->prefix . 'sales_client` (`SalesClientID`),
                            ADD CONSTRAINT `marketing_promotion_client_ibfk_3` FOREIGN KEY (`invoice`) REFERENCES `' . $db->prefix . 'sales_invoice` (`SalesInvoiceID`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}