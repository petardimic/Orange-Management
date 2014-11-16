<?php
namespace Framework\Validation {
    /**
     * Validator abstract
     *
     * PHP Version 5.4
     *
     * @category   Validation
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class CreditCard extends \Framework\Validation\ValidatorAbstract {
        private function __construct() {
        }

        public static function is_valid($value) {
            $value = preg_replace('/\D/', '', $value);

        // Set the string length and parity
            $number_length = strlen($value);
            $parity = $number_length % 2;

        // Loop through each digit and do the maths
            $total = 0;
            for ($i = 0; $i<$number_length; $i++) {
                $digit = $value[$i];
        // Multiply alternate digits by two
                if ($i % 2 == $parity) {
                    $digit *= 2;
        // If the sum is two digits, add them together (in effect)
                    if ($digit > 9) {
                        $digit -= 9;
                    }
                }
    // Total up the digits
                $total += $digit;
            }

    // If the total mod 10 equals 0, the value is valid
            return ($total % 10 == 0) ? true : false;
        }
    }
}