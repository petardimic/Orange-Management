<?php
namespace Modules\Accounting\Admin {
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_debitor` (
                            `AccountingDebitorID` int(11) NOT NULL AUTO_INCREMENT,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`AccountingDebitorID`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_debitor`
                            ADD CONSTRAINT `accounting_debitor_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'sales_client` (`SalesClientID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_creditor` (
                            `AccountingCreditorID` int(11) NOT NULL AUTO_INCREMENT,
                            `account` int(11) NOT NULL,
                            PRIMARY KEY (`AccountingCreditorID`),
                            KEY `account` (`account`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'accounting_creditor`
                            ADD CONSTRAINT `accounting_creditor_ibfk_1` FOREIGN KEY (`account`) REFERENCES `' . $db->prefix . 'purchase_suppliers` (`PurchaseSupplierID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'accounting_accounts` (
                            `AccountingAccountID` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(25) NOT NULL,
                            `description` varchar(255) NOT NULL,
                            `pnl` tinyint(1) NOT NULL,
                            `pnl` tinyint(1) NOT NULL,
                            PRIMARY KEY (`AccountingAccountID`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}