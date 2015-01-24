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
                    'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accountsreceivable` (
                            `accountsreceivable_id` int(11) NOT NULL AUTO_INCREMENT,
                            `accountsreceivable_account` int(11) NOT NULL,
                            PRIMARY KEY (`accountsreceivable_id`),
                            KEY `account` (`accountsreceivable_account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $db->con->prepare(
                    'ALTER TABLE `' . $db->prefix . 'accountsreceivable`
                            ADD CONSTRAINT `' . $db->prefix . 'accountsreceivable_ibfk_1` FOREIGN KEY (`accountsreceivable_account`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                )->execute();
                break;
        }

        parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
    }
}