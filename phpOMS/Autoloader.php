<?php

namespace phpOMS;

spl_autoload_register('\phpOMS\Autoloader::default_autoloader');

/**
 * Autoloader class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Autoloader
{
    /**
     * Check if class exists
     *
     * @param string $class Class path
     *
     * @return false|string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function exists($class) {
        $class = ltrim($class, '\\');
        $class = str_replace(['_', '\\'], DIRECTORY_SEPARATOR, $class);

        if(file_exists(__DIR__ . '/../' . $class . '.php')) {
            return $class;
        }

        return false;
    }

    /**
     * Loading classes by namespace + class name
     *
     * @param string $class Class path
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function default_autoloader($class)
    {
        if(($class = self::exists($class)) !== false) {
            /** @noinspection PhpIncludeInspection */
            include __DIR__ . '/../' . $class . '.php';
        }
    }
}
