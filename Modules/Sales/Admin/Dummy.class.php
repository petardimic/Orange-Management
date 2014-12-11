<?php
namespace Modules\Sales\Admin {
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
    class Dummy implements \Framework\Install\DummyInterface {
        /**
         * Generate dummy data
         *
         * @param \Framework\DataStorage\Database\Database $db     Database instance
         * @param int                                      $amount Amount of dummy entries
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function generate($db, $amount) {
        }
    }
}