<?php
namespace Modules\Sales\Admin;

/**
 * Dummy class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Sales
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
        $clients  = '';
        $invoices = '';
        $articles = '';

        for($i = 0; $i < $amount; $i++) {
            $clients .= " ('" . \Framework\Utils\RnG\String::generateString(5, 15) . "', " . rand(1, $amount - 1) . "),";
            $invoices .= " (" . (rand(1, 7)) . ", " . (rand(1, 5)) . ", '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', " . (rand(0, 100000) / 10) . ", 'usd', " . rand(1, 50) . ", " . rand(1, 1000) . ", " . rand(1, 50) . "),";
            $articles .= " (" . rand(1, 100) . ", " . rand(1, 100) . ", " . rand(1, 100) . ", " . rand(1, $amount - 1) . "),";
        }

        $clients  = rtrim($clients, ',');
        $invoices = rtrim($invoices, ',');
        $articles = rtrim($articles, ',');

        $db->con->prepare('INSERT INTO `' . $db->prefix . 'sales_client` (`matchcode`, `account`) VALUES ' . $clients)->execute();
        $db->con->prepare('INSERT INTO `' . $db->prefix . 'sales_invoice` (`status`, `type`, `created`, `printed`, `price`, `currency`, `creator`, `client`, `referer`) VALUES ' . $invoices)->execute();
        $db->con->prepare('INSERT INTO `' . $db->prefix . 'sales_articles` (`class`, `group`, `subgroup`, `article`) VALUES ' . $articles)->execute();
    }
}