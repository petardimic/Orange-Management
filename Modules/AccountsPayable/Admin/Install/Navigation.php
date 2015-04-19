<?php
namespace Modules\AccountsPayable\Admin\Install;

/**
 * Navigation class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Navigation
{
    public static function install($dbPool)
    {
        $navData = json_decode(file_get_contents(__DIR__ . '/nav.install.json'), true);

        $class = '\\Modules\\Navigation\\Admin\\Install';
        $class::installExternal($dbPool, $navData);
    }
}