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
abstract class ConnectionAbstract implements \phpOMS\DataStorage\Database\Connection\ConnectionInterface
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
    protected $dbdata = null;

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
    protected $type = null;

    /**
     * Database status
     *
     * @var \phpOMS\DataStorage\Database\DatabaseStatus
     * @since 1.0.0
     */
    protected $status = \phpOMS\DataStorage\Database\DatabaseStatus::CLOSED;

    /**
     * Database grammar
     *
     * @var \phpOMS\DataStorage\Database\Query\Grammar\Grammar
     * @since 1.0.0
     */
    private $grammar = null;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function getGrammar()
    {
        if(!isset($this->grammar)) {
            $this->grammar = new \phpOMS\DataStorage\Database\Query\Grammar\Grammar();
        }

        return $this->grammar;
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        $this->con    = null;
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
