<?php
namespace Framework\Datatypes {
    /**
     * Location class
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
    class Location {
        /**
         * Zip or postal
         *
         * @var string
         * @since 1.0.0
         */
        public $postal = null;

        /**
         * Name of city
         *
         * @var string
         * @since 1.0.0
         */
        public $city = null;

        /**
         * Name of the country
         *
         * @var string
         * @since 1.0.0
         */
        public $country = null;

        /**
         * Street & district
         *
         * @var string
         * @since 1.0.0
         */
        public $address = null;

        /**
         * State
         *
         * @var string
         * @since 1.0.0
         */
        public $state = null;

        /**
         * Geo coordinates
         *
         * @var float[]
         * @since 1.0.0
         */
        public $geo= null;
    }
}