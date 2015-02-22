<?php
namespace Modules\AreaManager\Admin;

/**
 * Area manager class
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
class Install extends \phpOMS\Install\Module
{
    /**
     * Install module
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database instance
     * @param array                             $info   Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'area_manager_area` (
                            `area_manager_area_id` int(11) NOT NULL AUTO_INCREMENT,
                            `area_manager_area_name` varchar(50) NOT NULL,
                            PRIMARY KEY (`area_manager_area_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'area_manager_account` (
                            `area_manager_account_id` int(11) NOT NULL AUTO_INCREMENT,
                            `area_manager_account_start` datetime NOT NULL,
                            `area_manager_account_end` datetime NOT NULL,
                            `area_manager_account_account int(11) NOT NULL,
                            `area_manager_account_area int(11) NOT NULL,
                            PRIMARY KEY (`accounts_receivable_id`),
                            KEY `area_manager_account_account` (`area_manager_account_account`),
                            KEY `area_manager_account_area` (`area_manager_account_area`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'area_manager_account`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'area_manager_account_ibfk_1` FOREIGN KEY (`area_manager_account_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'area_manager_account_ibfk_2` FOREIGN KEY (`area_manager_account_area`) REFERENCES `' . $dbPool->get('core')->prefix . 'area_manager_area` (`area_manager_area_id`);'
                )->execute();
                break;
        }

        parent::installProviding($dbPool, __DIR__ . '/nav.install.json', 'Navigation');
    }
}