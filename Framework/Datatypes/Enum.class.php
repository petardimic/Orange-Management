<?php
namespace Framework\Datatypes {

    /**
     * Enum class
     *
     * Replacing the SplEnum class and providing basic enum.
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
    abstract class Enum {
        private static $constCache = null;

        private static function getConstants() {
            if (self::$constCache === null) {
                $reflect          = new \ReflectionClass(get_called_class());
                self::$constCache = $reflect->getConstants();
            }

            return self::$constCache;
        }

        public static function isValidName($name, $strict = false) {
            $constants = self::getConstants();

            if ($strict) {
                return array_key_exists($name, $constants);
            }

            $keys = array_map('strtolower', array_keys($constants));

            return in_array(strtolower($name), $keys);
        }

        public static function isValidValue($value) {
            $values = array_values(self::getConstants());

            return in_array($value, $values, $strict = true);
        }
    }
}
