<?php
namespace phpOMS\DataStorage\Database\Connection;

/**
 * Database connection factory
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
class ConnectionFactory
{
    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function __construct()
    {
    }

    /**
     * Create database connection
     *
     * Overwrites current connection if existing
     *
     * @param string[] $dbdata the basic database information for establishing a connection
     *
     * @return \phpOMS\DataStorage\Database\Connection\ConnectionInterface
     *
     * @throws \Exception
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function create($dbdata)
    {
        switch($dbdata['db']) {
            case 'mysql':
                return new \phpOMS\DataStorage\Database\Connection\MysqlConnection($dbdata);
                break;
            default:
                throw new \Exception('Unknown database type');
        }
    }
}
