<?php
namespace Modules\Accounting\Admin;

/**
 * Dummy class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Accounting
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
        $debitors  = '';
        $creditors = '';

        for($i = 0; $i < $amount; $i++) {
            $debitors .= " (" . rand(1, $amount - 1) . "),";
            $creditors .= " (" . rand(1, $amount - 1) . "),";
        }

        $debitors  = rtrim($debitors, ',');
        $creditors = rtrim($creditors, ',');

        $db->con->prepare('INSERT INTO `' . $db->prefix . 'accounting_debitor` (`account`) VALUES ' . $debitors)->execute();
        $db->con->prepare('INSERT INTO `' . $db->prefix . 'accounting_creditor` (`account`) VALUES ' . $creditors)->execute();
    }
}