<?php
namespace Framework\DataStorage\Database;
    /**
     * Database handler
     *
     * Handles the database connection.
     * Implementing wrapper functions for multiple databases is planned (far away).
     *
     * PHP Version 5.4
     *
     * @category   Framework
     * @package    Framework\DataStorage\Database
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Database
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
         * @var \Framework\DataStorage\Database\DatabaseType
         * @since 1.0.0
         */
        private $type = null;

        /**
         * Database status
         *
         * @var \Framework\DataStorage\Database\DatabaseStatus
         * @since 1.0.0
         */
        public $status = 0;

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
            $this->dbdata = $dbdata;
            $this->prefix = $dbdata['prefix'];

            switch($dbdata['db']) {
                case 'mysql':
                    $this->type = \Framework\DataStorage\Database\DatabaseType::MYSQL;
                    break;
            }

            try {
                $this->con = new \PDO($this->dbdata['db'] . ':host=' . $this->dbdata['host'] . ';dbname=' . $this->dbdata['database'] . ';charset=utf8', $this->dbdata['login'], $this->dbdata['password']);
                $this->con->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
                $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                $this->status = \Framework\DataStorage\Database\DatabaseStatus::OK;
            } catch(\PDOException $e) {
                $this->status = \Framework\DataStorage\Database\DatabaseStatus::MISSING_DATABASE;
                $this->con    = null;
            }
        }

        /**
         * Get the database type
         *
         * @return \Framework\DataStorage\Database\DatabaseType
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getType()
        {
            return $this->type;
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
            $this->con = null;
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
        public function generate_sql_filter($filter, $pre = false)
        {
            if(!isset($filter)) {
                return '';
            }

            return '';
        }

        public function create_table()
        {
            switch($this->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:

                    break;
            }
        }

        public function insert()
        {
            switch($this->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:

                    break;
            }
        }

        public function select()
        {
            switch($this->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:

                    break;
            }
        }

        public function update()
        {
            switch($this->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:

                    break;
            }
        }

        public function delete()
        {
            switch($this->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:

                    break;
            }
        }
    }
