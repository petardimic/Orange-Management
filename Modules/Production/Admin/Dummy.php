<?php
namespace Modules\Production\Admin;

/**
 * Dummy class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Production
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
        for($i = 0; $i < $amount; $i++) {
            $dataString = " (" . rand(1, 200) . ", " . rand(0, 7) . ", " . rand(1, 100000) . ", " . rand(1, 997) . ", " . rand(1, 997) . ", '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "')";
            $db->con->prepare('INSERT INTO `' . $db->prefix . 'production_process` (`product`, `status`, `quantity`, `for`, `orderer`, `ordered`, `due`, `planned`, `done`) VALUES ' . $dataString)->execute();
        }
    }
}