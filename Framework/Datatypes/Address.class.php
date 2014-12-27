<?php
namespace Framework\Datatypes {
    /**
     * Address class
     *
     * PHP Version 5.4
     *
     * @category   Datatypes
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Address
    {
        /**
         * Name of the receiver
         *
         * @var string
         * @since 1.0.0
         */
        public $name = null;

        /**
         * Sub of the address
         *
         * @var string
         * @since 1.0.0
         */
        public $sub = null;

        /**
         * Location
         *
         * @var \Framework\Datatypes\Location
         * @since 1.0.0
         */
        public $location = null;
    }
}