<?php
namespace phpOMS\DataStorage\Cache;

/**
 * RedisCache class
 *
 * PHP Version 5.6
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
class RedisCache implements \phpOMS\DataStorage\Cache\CacheInterface
{
    /**
     * {@inheritdoc}
     */
    public function set($key, $value, $type = null, $expire = 2592000)
    {
        // TODO: Implement set() method.
    }

    /**
     * {@inheritdoc}
     */
    public function add($key, $value, $type = null, $expire = 2592000)
    {
        // TODO: Implement add() method.
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $type = null)
    {
        // TODO: Implement get() method.
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key, $type = null)
    {
        // TODO: Implement delete() method.
    }

    /**
     * {@inheritdoc}
     */
    public function flush($type = null)
    {
        // TODO: Implement flush() method.
    }

    /**
     * {@inheritdoc}
     */
    public function replace($key, $value, $type = null)
    {
        // TODO: Implement replace() method.
    }

    /**
     * {@inheritdoc}
     */
    public function stats()
    {
        // TODO: Implement stats() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getThreshold()
    {
        // TODO: Implement getThreshold() method.
    }
}