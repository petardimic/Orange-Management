<?php
namespace phpOMS\DataStorage\Database\Connection;

/**
 * Database connection interface
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
interface ConnectionInterface
{
    /**
     * Connect to database
     *
     * Overwrites current connection if existing
     *
     * @param string[] $dbdata the basic database information for establishing a connection
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function connect($dbdata);

    /**
     * Get the database type
     *
     * @return \phpOMS\DataStorage\Database\DatabaseType
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getType();

    /**
     * Get the database status
     *
     * @return \phpOMS\DataStorage\Database\DatabaseStatus
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStatus();

    /**
     * Close database connection
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function close();

    /**
     * Return grammar for this connection
     *
     * @return \phpOMS\DataStorage\Database\Query\Grammar\Grammar
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getGrammar();
}
