<?php
namespace phpOMS\DataStorage\Session;

/**
 * Session interface
 *
 * Sessions can be used by http requests, console interaction and socket connections
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\DataStorage\Cache
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
     * @param string|int $key       Value key
     * @param mixed      $value     Value to store
     * @param bool       $overwrite Overwrite existing values
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function set($key, $value, $overwrite = true);

    /**
     * Remove value from session by key
     *
     * @param string|int $key Value key
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function remove($key);

    /**
     * Save session
     *
     * @todo   : implement save type (session, cache, database)
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function save();

    /**
     * @return int|string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getSID();

    /**
     * @param int|string $sid
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setSID($sid);
}
