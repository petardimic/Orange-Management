<?php
namespace Modules\Admin\Admin {
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'admin_company` (
                            `AdminCompanyID` int(11) NOT NULL AUTO_INCREMENT,
                            `status` tinyint(2) DEFAULT NULL,
                            `matchcode` varchar(50) DEFAULT NULL,
                            `name` varchar(50) DEFAULT NULL,
                            PRIMARY KEY (`AdminCompanyID`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'admin_address` (
                            `AdminAddressID` int(11) NOT NULL AUTO_INCREMENT,
                            `status` tinyint(2) DEFAULT NULL,
                            `matchcode` varchar(50) DEFAULT NULL,
                            `name` varchar(50) DEFAULT NULL,
                            `fao` varchar(30) DEFAULT NULL,
                            `addr` varchar(50) DEFAULT NULL,
                            `city` varchar(20) DEFAULT NULL,
                            `zip` varchar(20) DEFAULT NULL,
                            `state` varchar(20) DEFAULT NULL,
                            `country` varchar(30) DEFAULT NULL,
                            `company` int(11) DEFAULT NULL,
                            PRIMARY KEY (`AdminAddressID`),
                            KEY `company` (`company`),
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'marketing_promotion_client`
                            ADD CONSTRAINT `admin_address_ibfk_1` FOREIGN KEY (`company`) REFERENCES `' . $db->prefix . 'admin_company` (`AdminCompanyID`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}