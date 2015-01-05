<?php
namespace Framework\Datatypes {
    /**
     * Location class
     *
     * PHP Version 5.4
     *
     * @category   Framework
     * @package    Framework\Datatypes
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Location
    {
        /**
         * Zip or postal
         *
         * @var string
         * @since 1.0.0
         */
        private $postal = null;

        /**
         * Name of city
         *
         * @var string
         * @since 1.0.0
         */
        private $city = null;

        /**
         * Name of the country
         *
         * @var string
         * @since 1.0.0
         */
        private $country = null;

        /**
         * Street & district
         *
         * @var string
         * @since 1.0.0
         */
        private $address = null;

        /**
         * State
         *
         * @var string
         * @since 1.0.0
         */
        private $state = null;

        /**
         * Geo coordinates
         *
         * @var float[]
         * @since 1.0.0
         */
        private $geo = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct()
        {
        }

        /**
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getPostal()
        {
            return $this->postal;
        }

        /**
         * @param string $postal
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setPostal($postal)
        {
            $this->postal = $postal;
        }

        /**
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getCity()
        {
            return $this->city;
        }

        /**
         * @param string $city
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setCity($city)
        {
            $this->city = $city;
        }

        /**
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getCountry()
        {
            return $this->country;
        }

        /**
         * @param string $country
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setCountry($country)
        {
            $this->country = $country;
        }

        /**
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getAddress()
        {
            return $this->address;
        }

        /**
         * @param string $address
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setAddress($address)
        {
            $this->address = $address;
        }

        /**
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getState()
        {
            return $this->state;
        }

        /**
         * @param string $state
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setState($state)
        {
            $this->state = $state;
        }

        /**
         * @return \float[]
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getGeo()
        {
            return $this->geo;
        }

        /**
         * @param \float[] $geo
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setGeo($geo)
        {
            $this->geo = $geo;
        }
    }
}