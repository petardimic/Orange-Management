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
        public $postal = null;

        public $city = null;

        public $country = null;

        public $address = null;

        public $state = null;

        public $geo_coord = null;
    }
}