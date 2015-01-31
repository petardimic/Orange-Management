<?php
namespace Framework\DataStorage\Session;

/**
 * Session interface
 *
 * Sessions can be used by http requests, console interaction and socket connections
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Framework\DataStorage\Cache
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface SessionInterface
{
    /**
     * Get session variable by key
     *
     * @param string|int $key Value key
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function get($key);

    /**
     * Store session value by key
     *
     * @param string|int $key   Value key
     * @param mixed      $value Value to store
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function set($key, $value);

    /**
     * Remove value from session by key
     *
     * @param string|int $key Value key
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function remove($key);
}