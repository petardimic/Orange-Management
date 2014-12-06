<?php
namespace Framework\Install {
    /**
     * Dummy data factory
     *
     * Used in order to install dummy data of modules
     *
     * PHP Version 5.4
     *
     * @category   Install
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class DummyFactory {
        public static function generate($db, $module, $amount = 9997) {
            if(file_exists(__DIR__ . '/../../Modules/' . $module . '/Admin/Dummy.class.php')) {
                $class = '\\Modules\\' . $module . '\\Admin\\Dummy';
                $class::generate($db, $amount);
            }
        }
    }
}