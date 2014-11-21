<?php
namespace Framework\Localization\DateTime {
    /**
     * Localization class
     *
     * PHP Version 5.4
     *
     * @category   Localization
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class DateTime {
        private $local = null;

        public function __constructor() {
        }

        public function format($date) {
            if(is_string($date)) {

            } elseif($date instanceof \DateTime) {
                return $date->format('Y-m-d H:i:s');
            }

            return null;
        }
    }
}