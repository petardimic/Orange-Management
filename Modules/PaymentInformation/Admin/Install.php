<?php
namespace Modules\PaymentInformation\Admin;

/**
 * Accounts receivable install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\AccountsReceivable
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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'payment_info` (
                            `payment_info_id` int(11) NOT NULL AUTO_INCREMENT,
                            `payment_info_account` int(11) DEFAULT NULL,
                            PRIMARY KEY (`payment_info_id`),
                            KEY `payment_info_account` (`payment_info_account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'payment_info`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'payment_info_ibfk_1` FOREIGN KEY (`payment_info_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();
                break;
        }
    }
}