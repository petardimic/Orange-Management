<?php

namespace phpOMS\DataStorage\Database;

/**
 * Database pool handler
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\DataStorage\Database
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Pool
{

// region Class Fields
    /**
     * Databases
     *
     * @var \phpOMS\DataStorage\Database\Connection\ConnectionAbstract[]
     * @since 1.0.0
     */
    private $pool = [];

// endregion

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
    }

    /**
     * Add database
     *
     * @param mixed                                                      $key Database key
     * @param \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $db  Database
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function add($key = 'core', $db)
    {
        if(isset($this->pool[$key])) {
            return false;
        }

        $this->pool[$key] = $db;

        return true;
    }

    /**
     * Get database
     *
     * @param mixed $key Database key
     *
     * @return \phpOMS\DataStorage\Database\Connection\ConnectionAbstract
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function get($key = 'core')
    {
        if(!isset($this->pool[$key])) {
            return false;
        }

        return $this->pool[$key];
    }

    /**
     * Remove database
     *
     * @param mixed $key Database key
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function remove($key)
    {
        if(!isset($this->pool[$key])) {
            return false;
        }

        unset($this->pool[$key]);

        return true;
    }

    /**
     * Create database
     *
     * @param mixed $key    Database key
     * @param array $config Database config data
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function create($key, $config)
    {
        if(isset($this->pool[$key])) {
            return true;
        }

        $this->pool[$key] = \phpOMS\DataStorage\Database\Connection\ConnectionFactory::create($config);

        return true;
    }
}
