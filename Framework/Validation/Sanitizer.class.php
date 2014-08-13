<?php
namespace Framework\Validation {
    /**
     * Sanitizer class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Sanitizer {
        private function __construct() {

        }

        public static function validate_array($val, $type) {

        }

        public static function validate($val, $type) {
            switch($type) {
                case 'int':
                    return is_int($val);
                case 'float':
                    return is_float($val);
                case 'bool':
                    return is_bool($val);
                case 'wstring':
                    return (bool) preg_match('^\p{L}*$', $val);
                case 'wistring':
                    return (bool) preg_match('^(\p{L}|[0-9])*$', $val);
                case 'email':
                    return filter_var($val, FILTER_VALIDATE_EMAIL);
                case 'website':
                    return filter_var($val, FILTER_VALIDATE_URL);
                default:
                    return false;
            }
        }

        public static function sanitize($val, $type) {
            switch($type) {
                case 'int':
                    return (int)$val;
                case 'float':
                    return (float)$val;
                case 'bool':
                    return (bool)$val;
                case 'wstring':
                    return preg_replace('[^\p{L}]', '', $val);
                case 'wistring':
                    return preg_replace('[^(\p{L}|0-9)]', '', $val);
                default:
                    return null;
            }
        }
    }
}