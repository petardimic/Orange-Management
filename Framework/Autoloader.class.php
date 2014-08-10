<?php

namespace Framework {
    /**
     * Autoloader class
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
    //spl_autoload_extensions('.class.php');
    spl_autoload_register('\Framework\Autoloader::default_autoloader');

    class Autoloader {
        public static function default_autoloader($class) {
            $class = ltrim($class, '\\');

            $file = __DIR__ . '/../';
            if ($lastNsPos = strrpos($class, '\\')) {
                $namespace = substr($class, 0, $lastNsPos);
                $class     = substr($class, $lastNsPos + 1);
                $file .= str_replace('\\', '/', $namespace) . '/';
            }

            $file .= $class . '.class.php';

            if (!file_exists($file)) {
                throw new \Exception();
            }

            /** @noinspection PhpIncludeInspection */
            include $file;
        }
    }
}