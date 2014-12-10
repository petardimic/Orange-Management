<?php
namespace Framework\Localization\DateTime {
    /**
     * DateTime localization class
     *
     * PHP Version 5.4
     *
     * @category   Framework
     * @package    Localization
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class DateTime {
        /**
         * Local id
         *
         * @var string
         * @since 1.0.0
         */
        private $local = null;

        /**
         * Constructor
         *
         * @var string
         * @since 1.0.0
         */
        public function __constructor() {
        }

        /**
         * Set local ID
         *
         * @param string $local Local ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setLocal($local) {
            $this->local = $local;
        }

        /**
         * Format DateTime
         *
         * @param string|\DateTime $date  Date
         * @param string|null      $local Local ID
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function format($date, $local = null) {
            $format = 'Y-m-d H:i:s';

            if($local == null) {
                $local = $this->local;
            }

            /** TODO: implement */
            switch($local) {
                case 'DE':
                    $format = 'd-m-Y H:i:s';
                    break;
            }

            /** TODO: make sure to also allow string that only contain date (no time) */

            if(is_string($date)) {
                // TODO: check if string is valid
                return (new \DateTime($date))->format($format);
            } elseif($date instanceof \DateTime) {
                return $date->format($format);
            }

            return null;
        }
    }
}