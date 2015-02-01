<?php
namespace Modules\AccountsPayable\Admin;

/**
 * Accounts payable install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\AccountsPayable
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
     * @param \Framework\DataStorage\Database\Pool $dbPool   Database instance
     * @param array                                    $info Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'accountspayable` (
                            `accountspayable_id` int(11) NOT NULL AUTO_INCREMENT,
                            `accountspayable_account` int(11) NOT NULL,
                            PRIMARY KEY (`accountspayable_id`),
                            KEY `account` (`accountspayable_account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'accountspayable`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'accountspayable_ibfk_1` FOREIGN KEY (`accountspayable_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'sales_client` (`sales_client_id`);'
                )->execute();
                break;
        }

        parent::installProviding($dbPool, __DIR__ . '/nav.install.json', 'Navigation');
    }
}