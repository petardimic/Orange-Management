<?php
namespace Framework\Validation {
    /**
     * Validator interface
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
    interface ValidatorInterface {
        /**
         * Check if value is valid
         *
         * @param mixed $value Value to validate
         *
         * @return bool
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public static function isValid($value);

        /**
         * Get most recent error string
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public static function getMessage();
    }
}