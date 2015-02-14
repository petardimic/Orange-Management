<?php
namespace phpOMS\Validation;

/**
 * Model validation trait
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Config
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
trait ModelValidationTrait
{
    /** @noinspection PhpUnusedPrivateMethodInspection */
    /**
     * Validate member variable
     *
     * @param mixed  $var  Variable to validate
     * @param string $name Name of the variable
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function isValid($var, $name)
    {
        /** @noinspection PhpUndefinedFieldInspection */
        if(!isset(self::${$name . '_validate'})) {
            return true;
        }

        /** @noinspection PhpUndefinedFieldInspection */
        return \phpOMS\Validation\Validator::isValid($var, self::$validation[$name]);
    }
}