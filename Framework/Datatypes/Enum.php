<?php
namespace Framework\Datatypes;

/**
 * Enum class
 *
 * Replacing the SplEnum class and providing basic enum.
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
abstract class Enum
{
    /**
     * Caching constant values
     *
     * @var array
     * @since 1.0.0
     */
    private static $constCache = null;

    /**
     * Getting all constants of this enum
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getConstants()
    {
        if(self::$constCache === null) {
            $reflect          = new \ReflectionClass(get_called_class());
            self::$constCache = $reflect->getConstants();
        }

        return self::$constCache;
    }

    /**
     * Checking enum name
     *
     * Checking if a certain const name exists (case sensitive)
     *
     * @param string $name Name of the value (case sensitive)
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function isValidName($name)
    {
        $constants = self::getConstants();

        return array_key_exists($name, $constants);
    }

    /**
     * Check enum value
     *
     * Checking if a given value is part of this enum
     *
     * @param mixed $value Value to check
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function isValidValue($value)
    {
        $values = array_values(self::getConstants());

        return in_array($value, $values, $strict = true);
    }
}