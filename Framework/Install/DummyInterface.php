<?php
namespace Framework\Install {
    /**
     * Dummy data interface
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
    interface DummyInterface
    {
        /**
         * Generate dummy data
         *
         * @param \Framework\DataStorage\Database\Database $db     Database instance
         * @param int                                      $amount Amount of dummy data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function generate($db, $amount);
    }
}