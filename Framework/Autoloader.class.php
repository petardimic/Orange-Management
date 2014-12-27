<?php

namespace Framework {
    spl_autoload_register('\Framework\Autoloader::default_autoloader');

    /**
     * Autoloader class
     *
     * PHP Version 5.4
     *
     * @category   App
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
         * Loading classes by namespace + class name
         *
         * @param string $class Class path
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function default_autoloader($class)
        {
            $class = ltrim($class, '\\');

            /** @noinspection PhpIncludeInspection */
            include __DIR__ . '/../' . $class . '.class.php';
        }
    }
}
