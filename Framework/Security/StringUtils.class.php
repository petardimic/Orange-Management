<?php
namespace Framework\Security {
    /**
     * String utils
     *
     * PHP Version 5.4
     *
     * @category   Framework
     * @package    Converter
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class StringUtils
    {
        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function __construct()
        {
        }

        /**
         * Compare two strings
         *
         * This utilizes a constant time algroithm
         *
         * @param string $a First string
         * @param string $b Second string
         *
         * @return bool
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function equals($a, $b)
        {
            $a = (string) $a;
            $b = (string) $b;

            if(function_exists('hash_equals')) {
                return hash_equals($a, $b);
            }

            $aLength = strlen($a);
            $bLength = strlen($b);

            $a .= $b;

            $result = $aLength - $bLength;

            for($i = 0; $i < $bLength; $i++) {
                $result |= (ord($a[$i]) ^ ord($b[$i]));
            }

            return $result === 0;
        }
    }
}