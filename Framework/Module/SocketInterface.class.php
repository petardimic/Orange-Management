<?php
namespace Framework\Module {
    /**
     * Socket module interface
     *
     * PHP Version 5.4
     *
     * @category   Module
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    interface SocketInterface
    {
        /**
         * Answer socket request
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function callSock();
    }
}