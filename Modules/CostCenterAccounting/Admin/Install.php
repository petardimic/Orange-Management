<?php
namespace Modules\CostCenterAccounting\Admin;

/**
 * Navigation class
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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'cost_center_accounting` (
                            `cost_center_accounting_id` int(11) NOT NULL AUTO_INCREMENT,
                            `cost_center_accounting_name` varchar(25) NOT NULL,
                            `cost_center_accounting_description` varchar(255) NOT NULL,
                            `cost_center_accounting_parent` int(11) NOT NULL,
                            PRIMARY KEY (`cost_center_accounting_id`),
                            KEY `cost_center_accounting_parent` (`cost_center_accounting_parent`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'cost_center_accounting`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'cost_center_accounting_ibfk_1` FOREIGN KEY (`cost_center_accounting_parent`) REFERENCES `' . $dbPool->get('core')->prefix . 'cost_center_accounting` (`cost_center_accounting_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'accounting_posting_ele`
                        ADD `accounting_posting_ele_costcenter` int(11) NOT NULL,
                        ADD KEY `accounting_posting_ele_costcenter` (`accounting_posting_ele_costcenter`),
                        ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'accounting_posting_ele_ibfk_2` FOREIGN KEY (`accounting_posting_ele_costcenter`) REFERENCES `' . $dbPool->get('core')->prefix . 'cost_center_accounting` (`cost_center_accounting_id`);'
                )->execute();
                break;
        }
    }
}