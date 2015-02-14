<?php
namespace Modules\HumanResources\Admin;

/**
 * Dummy class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    HumanResources
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Dummy implements \phpOMS\Install\DummyInterface
{
    /**
     * {@inheritdoc}
     */
    public static function generate($dbPool, $amount)
    {
        $dbPool->get('core')->con->beginTransaction();

        $dataString = " ('Human Resource Department', NULL),"
                      . "('Accounting Department', NULL),"
                      . "('Accounting (debitor) Department', 2),"
                      . "('Accounting (creditor) Department', 2),"
                      . "('Sales Department', NULL),"
                      . "('Sales (national) Department', 5),"
                      . "('Sales (international) Department', 5),"
                      . "('Purchasing Department', NULL),"
                      . "('Warehousing', NULL),"
                      . "('Shipping Department', 9),"
                      . "('Arrival Department', 9),"
                      . "('Quality Management Department', NULL),"
                      . "('Research & Development Department', NULL),"
                      . "('Service Department', NULL),"
                      . "('Support Department', NULL),"
                      . "('Administration', NULL),"
                      . "('Management', NULL),"
                      . "('Controlling', 17),"
                      . "('IT Department', NULL)";
        $dbPool->get('core')->con->prepare('INSERT INTO `' . $dbPool->get('core')->prefix . 'hr_department` (`name`, `parent`) VALUES ' . $dataString)->execute();

        $amount = 197;
        $uid    = [];

        for($i = 0; $i < $amount; $i++) {
            $id = rand(1, 995);

            if(in_array($id, $uid)) {
                continue;
            }

            $dataString = " ( " . rand(0, 3) . ", " . $id . ")";
            $dbPool->get('core')->con->prepare('INSERT INTO `' . $dbPool->get('core')->prefix . 'hr_staff` (`status`, `person`) VALUES ' . $dataString)->execute();
        }

        $dbPool->get('core')->con->commit();
    }
}