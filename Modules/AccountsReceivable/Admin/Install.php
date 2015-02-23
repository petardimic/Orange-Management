<?php
namespace Modules\AccountsReceivable\Admin;

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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'accounts_receivable` (
                            `accounts_receivable_id` int(11) NOT NULL AUTO_INCREMENT,
                            `accounts_receivable_account` int(11) NOT NULL,
                            PRIMARY KEY (`accounts_receivable_id`),
                            KEY `accounts_receivable_id` (`accounts_receivable_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'accounts_receivable`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'accounts_receivable_ibfk_1` FOREIGN KEY (`accounts_receivable_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'accounts_receivable_payment` (
                            `accounts_receivable_payment_id` int(11) NOT NULL AUTO_INCREMENT,
                            `accounts_receivable_payment_account` int(11) DEFAULT NULL,
                            `accounts_receivable_payment_info` int(11) DEFAULT NULL,
                            PRIMARY KEY (`accounts_receivable_payment_id`),
                            KEY `accounts_receivable_payment_account` (`accounts_receivable_payment_account`),
                            KEY `accounts_receivable_payment_info` (`accounts_receivable_payment_info`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'accounts_receivable_payment`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'accounts_receivable_payment_ibfk_1` FOREIGN KEY (`accounts_receivable_payment_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'accounts_receivable` (`accounts_receivable_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'accounts_receivable_payment_ibfk_2` FOREIGN KEY (`accounts_receivable_payment_info`) REFERENCES `' . $dbPool->get('core')->prefix . 'payment_info` (`payment_info_id`);'
                )->execute();
                break;
        }
    }
}