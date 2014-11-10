<?php
namespace Framework\Pattern {
    /**
     * Multition interface (pattern)
     *
     * PHP Version 5.4
     *
     * @category   Pattern
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    interface Multition {
        /**
         * @param mixed                     $id  Object id
         * @param \Framework\WebApplication $app Application reference
         *
         * @return Multition
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($id, $app);

        public function __clone();
    }
}
