<?php
namespace Framework\Core {
    abstract class DatabaseType extends \Framework\Base\Enum {
        const MYSQL = 0;
        const SQLITE = 1;
    }

    abstract class DatabaseStatus extends \Framework\Base\Enum {
        const OK = 0;
        const MISSING_DATABASE = 1;
        const MISSING_TABLE = 2;
        const FAILURE = 3;
        const READONLY = 4;
    }

    interface ObjectInterface extends \Serializable {
        public function delete();
        public function create();
        public function edit();
    }

    interface ObjectListInterface {
        public function get_object();

        public function instantiate();
    }

    /**
     * Database handler
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Database implements \Framework\Base\Singleton {
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
         * @var int
         * @since 1.0.0
         */
        public $type = null;

        /**
         * Database status
         *
         * @var int
         * @since 1.0.0
         */
        public $status = 0;

        /**
         * Instance
         *
         * @var \Framework\Core\Database
         * @since 1.0.0
         */
        protected static $instance = null;

        /**
         * Object constructor
         *
         * Creates the database object and overwrites all default values.
         *
         * @param array $dbdata the basic database information for establishing a connection
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($dbdata) {
            $this->dbdata = $dbdata;
            $this->prefix = $dbdata['prefix'];

            if ($dbdata['db'] === 'mysql') {
                $this->type = \Framework\Core\DatabaseType::MYSQL;
            }

            try {
                $this->con = new \PDO($this->dbdata['db'] . ':host=' . $this->dbdata['host'] . ';dbname=' . $this->dbdata['database'] . ';charset=utf8', $this->dbdata['login'], $this->dbdata['password']);
                $this->con->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
                $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                $this->status = \Framework\Core\DatabaseStatus::OK;
            } catch (\PDOException $e) {
                $this->status = \Framework\Core\DatabaseStatus::MISSING_DATABASE;
                $this->con = null;
            }

            try {
                $result = $this->con->query('SELECT 1 FROM ' . $this->prefix . 'settings LIMIT 1');
            } catch (\PDOException $e) {
                $this->status = \Framework\Core\DatabaseStatus::MISSING_TABLE;
            }
        }

        /**
         * Protect instance from getting copied from outside
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        protected function __clone() {
        }

        /**
         * Object destructor
         *
         * Sets the database connection to null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __destruct() {
            $this->con = null;
        }

        /**
         * Returns instance
         *
         * @param array $dbdata the basic database information for establishing a connection
         *
         * @return \Framework\Core\Database
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($dbdata = null) {
            if (self::$instance === null) {
                self::$instance = new self($dbdata);
            }

            return self::$instance;
        }

        /**
         * Generates a filter for query
         *
         * @param array $filter Filter for the SQL query
         * @param bool  $pre    WHERE clause required?
         *
         * @return string Filter query
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public function generate_sql_filter($filter, $pre = false) {
            if (!isset($filter)) {
                return '';
            }

            return '';
        }
    }
}
