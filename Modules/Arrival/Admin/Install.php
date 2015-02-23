<?php
namespace Modules\Arrival\Admin;

/**
 * Arrival install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Admin
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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'arrival` (
                            `arrival_id` int(11) NOT NULL AUTO_INCREMENT,
                            `arrival_date` datetime NOT NULL,
                            `arrival_carrier` int(11) NOT NULL,
                            `arrival_responsible` int(11) NOT NULL,
                            PRIMARY KEY (`arrival_id`),
                            KEY `arrival_carrier` (`arrival_carrier`),
                            KEY `arrival_responsible` (`arrival_responsible`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'arrival`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'arrival_ibfk_1` FOREIGN KEY (`arrival_carrier`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'arrival_ibfk_2` FOREIGN KEY (`arrival_responsible`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'arrival_status` (
                            `arrival_status_id` int(11) NOT NULL AUTO_INCREMENT,
                            `arrival_status_amount` tinyint(1) NOT NULL,
                            `arrival_status_condition` tinyint(1) NOT NULL,
                            `arrival_status_arrival` int(11) NOT NULL,
                            PRIMARY KEY (`arrival_status_id`),
                            KEY `arrival_status_arrival` (`arrival_status_arrival`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'arrival_status`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'arrival_status_ibfk_1` FOREIGN KEY (`arrival_status_arrival`) REFERENCES `' . $dbPool->get('core')->prefix . 'arrival` (`arrival_id`);'
                )->execute();
                break;
        }
    }
}