<?php
namespace phpOMS\DataStorage\Database\Connection;

/**
 * Database handler
 *
 * Handles the database connection.
 * Implementing wrapper functions for multiple databases is planned (far away).
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
class Connection
{
    /**
     * Connection object
     *
     * This can be used externally to define queries and execute them.
     *
     * @var \PDO
     * @since 1.0.0
     */
    public $con = null;

    /**
     * Database data
     *
     * @var string[]
     * @since 1.0.0
     */
    public $dbdata = null;

    /**
     * Database prefix
     *
     * The database prefix name for unique table names
     *
     * @var string
     * @since 1.0.0
     */
    public $prefix = '';

    /**
     * Database type
     *
     * @var \phpOMS\DataStorage\Database\DatabaseType
     * @since 1.0.0
     */
    private $type = null;

    /**
     * Database status
     *
     * @var \phpOMS\DataStorage\Database\DatabaseStatus
     * @since 1.0.0
     */
    public $status = \phpOMS\DataStorage\Database\DatabaseStatus::CLOSED;

    /**
     * Object constructor
     *
     * Creates the database object and overwrites all default values.
     *
     * @param string[] $dbdata the basic database information for establishing a connection
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($dbdata)
    {
        $this->connect($dbdata);
    }

    public function connect($dbdata) {
        $this->close();

        $this->dbdata = $dbdata;
        $this->prefix = $dbdata['prefix'];

        switch($dbdata['db']) {
            case 'mysql':
                $this->type = \phpOMS\DataStorage\Database\DatabaseType::MYSQL;
                break;
        }

        try {
            $this->con = new \PDO($this->dbdata['db'] . ':host=' . $this->dbdata['host'] . ';dbname=' . $this->dbdata['database'] . ';charset=utf8', $this->dbdata['login'], $this->dbdata['password']);
            $this->con->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $this->status = \phpOMS\DataStorage\Database\DatabaseStatus::OK;
        } catch(\PDOException $e) {
            $this->status = \phpOMS\DataStorage\Database\DatabaseStatus::MISSING_DATABASE;
            $this->con    = null;
        }
    }

    /**
     * Get the database type
     *
     * @return \phpOMS\DataStorage\Database\DatabaseType
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Close database connection
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function close()
    {
        $this->con = null;
        $this->status = \phpOMS\DataStorage\Database\DatabaseStatus::CLOSED;
    }

    /**
     * Object destructor
     *
     * Sets the database connection to null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __destruct()
    {
        $this->close();
    }
}
