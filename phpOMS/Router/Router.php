<?php
namespace phpOMS\Router;

/**
 * Router class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Socket
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Router
{
    private static $routes = [];

    private function __construct()
    {
    }

    public static function any($route, $callback, $order = 0) {
        if(!isset(self::$routes[$route]['any'])) {
            self::$routes[$route]['any'] = [];
        }

        self::$routes[$route]['any'][] = $callback;

        return count(self::$routes[$route]['any'])-1;
    }

    public static function get($route, $callback, $order = 0) {
        if(!isset(self::$routes[$route]['get'])) {
            self::$routes[$route]['get'] = [];
        }

        self::$routes[$route]['get'][] = $callback;

        return count(self::$routes[$route]['get'])-1;
    }

    public static function post($route, $callback, $order = 0) {
        if(!isset(self::$routes[$route]['post'])) {
            self::$routes[$route]['post'] = [];
        }

        self::$routes[$route]['post'][] = $callback;

        return count(self::$routes[$route]['post'])-1;
    }

    public static function delete($route, $callback, $order = 0) {
        if(!isset(self::$routes[$route]['delete'])) {
            self::$routes[$route]['delete'] = [];
        }

        self::$routes[$route]['delete'][] = $callback;

        return count(self::$routes[$route]['delete'])-1;
    }

    public static function execute($route, $parameters, $id = null) {
        if(isset($id)) {
            $route = self::$any[$route][$id];
            yield $route(...$parameters);
        } else {
            foreach(self::$any[$route] as $route) {
                yield $route(...$parameters);
            }
        }
    }
}