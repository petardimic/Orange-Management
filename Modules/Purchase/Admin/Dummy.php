<?php
namespace Modules\Purchase\Admin;
    /**
     * Dummy class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Purchase
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Dummy implements \Framework\Install\DummyInterface
    {
        /**
         * {@inheritdoc}
         */
        public static function generate($db, $amount)
        {
            $suppliers = '';
            $invoices  = '';
            $articles  = '';

            for($i = 0; $i < $amount; $i++) {
                $suppliers .= " ('" . \Framework\Utils\RnG\String::generateString(5, 15) . "', " . rand(1, $amount - 1) . "),";
                $invoices .= " (" . (rand(1, 7)) . ", " . (rand(1, 5)) . ", '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', " . (rand(0, 100000) / 10) . ", 'usd', " . rand(1, 50) . ", " . rand(1, 1000) . ", " . rand(1, 50) . "),";
                $articles .= " (" . rand(1, $amount - 1) . "),";
            }

            $suppliers = rtrim($suppliers, ',');
            $invoices  = rtrim($invoices, ',');
            $articles  = rtrim($articles, ',');

            $db->con->prepare('INSERT INTO `' . $db->prefix . 'purchase_suppliers` (`matchcode`, `account`) VALUES ' . $suppliers)->execute();
            $db->con->prepare('INSERT INTO `' . $db->prefix . 'purchase_invoices` (`status`, `type`, `created`, `printed`, `price`, `currency`, `creator`, `supplier`, `referer`) VALUES ' . $invoices)->execute();
            $db->con->prepare('INSERT INTO `' . $db->prefix . 'purchase_articles` (`article`) VALUES ' . $articles)->execute();
        }
    }