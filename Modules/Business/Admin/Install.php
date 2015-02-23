<?php
namespace Modules\Business\Admin;

/**
 * Business install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Business
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
     * @param \phpOMS\DataStorage\Database\Pool $dbPool   Database instance
     * @param array                                    $info Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'business_unit` (
                            `business_unit_id` int(11) NOT NULL AUTO_INCREMENT,
                            `business_unit_status` tinyint(2) DEFAULT NULL,
                            `business_unit_matchcode` varchar(50) DEFAULT NULL,
                            `business_unit_name` varchar(50) DEFAULT NULL,
                            PRIMARY KEY (`business_unit_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'business_department` (
                            `business_department_id` int(11) NOT NULL AUTO_INCREMENT,
                            `business_department_name` varchar(30) DEFAULT NULL,
                            `business_department_parent` int(11) DEFAULT NULL,
                            `business_department_unit` int(11) NOT NULL,
                            PRIMARY KEY (`business_department_id`),
                            KEY `business_department_parent` (`business_department_parent`),
                            KEY `business_department_unit` (`business_department_unit`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'business_department`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'business_department_ibfk_1` FOREIGN KEY (`business_department_parent`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_department` (`business_department_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'business_department_ibfk_2` FOREIGN KEY (`business_department_unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_unit` (`business_unit_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'business_address` (
                            `business_address_id` int(11) NOT NULL AUTO_INCREMENT,
                            `business_address_status` tinyint(2) DEFAULT NULL,
                            `business_address_matchcode` varchar(50) DEFAULT NULL,
                            `business_address_name` varchar(50) DEFAULT NULL,
                            `business_address_fao` varchar(30) DEFAULT NULL,
                            `business_address_addr` varchar(50) DEFAULT NULL,
                            `business_address_city` varchar(20) DEFAULT NULL,
                            `business_address_zip` varchar(20) DEFAULT NULL,
                            `business_address_state` varchar(20) DEFAULT NULL,
                            `business_address_country` varchar(30) DEFAULT NULL,
                            `business_address_unit` int(11) DEFAULT NULL,
                            PRIMARY KEY (`business_address_id`),
                            KEY `business_address_unit` (`business_address_unit`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'business_address`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'business_address_ibfk_1` FOREIGN KEY (`business_address_unit`) REFERENCES `' . $dbPool->get('core')->prefix . 'business_unit` (`business_unit_id`);'
                )->execute();
                break;
        }

        parent::installProviding($dbPool, __DIR__ . '/nav.install.json', 'Navigation');
    }
}