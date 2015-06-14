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
class MysqlConnection extends \phpOMS\DataStorage\Database\Connection\ConnectionAbstract
{
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
        $this->type = \phpOMS\DataStorage\Database\DatabaseType::MYSQL;
        $this->connect($dbdata);
    }

    /**
     * {@inheritdoc}
     */
    public function connect($dbdata = null)
    {
        $this->close();

        $this->dbdata = isset($dbdata) ? $dbdata : $this->dbdata;
        $this->prefix = $dbdata['prefix'];

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
}
