<?php
namespace Modules\Admin {
    /**
     * Users class
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
    class Users implements \Framework\Core\Database\ObjectListInterface, \Framework\Base\Singleton {
        /**
         * Database
         *
         * @var \Framework\Core\Database\Database
         * @since 1.0.0
         */
        private $db = null;

        /**
         * Cache instance
         *
         * @var \Framework\Core\Cache
         * @since 1.0.0
         */
        public $cache = null;

        /**
         * Instances
         *
         * @var \Framework\Core\Cache
         * @since 1.0.0
         */
        protected static $instance = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct() {
            $this->db    = \Framework\Core\Database\Database::getInstance();
            $this->cache = \Framework\Core\Cache::getInstance();
        }

        /**
         * Returns instance
         *
         * @return \Modules\Admin\Users
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }

            return self::$instance;
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
         * Create new account
         *
         * @param string $name Login name
         * @param string $pass Password
         * @param string $email Email
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function account_create($name, $pass, $email) {
            $date = new \DateTime("NOW");

            switch ($this->db->type) {
                case \Framework\Core\Database\DatabaseType::MYSQL:
                    $sth = $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts` (`login`, `password`, `email`, `llogin`, `tries`, `created`, `changed`) VALUES
                            (:aname, :pword, :email, \'0000-00-00 00:00:00\', 3, \'' . $date->format('Y-m-d H:i:s') . '\', 1);'
                    );

                    $sth->bindValue(':aname', $name, \PDO::PARAM_STR);
                    $sth->bindValue(':pword', $pass, \PDO::PARAM_STR);
                    $sth->bindValue(':email', $email, \PDO::PARAM_STR);
                    $sth->execute();
                    break;
            }
        }

        /**
         * Delete account
         *
         * This function gets called when a account gets deleted
         *
         * @param int $id User ID to delete
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function account_delete($id) {
        }

        /**
         * Get all accounts
         *
         * This function gets all accounts in a range
         *
         * @param array $filter Filter for search results
         * @param int   $offset Offset for first account
         * @param int   $limit  Limit for results
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function account_list_get($filter = null, $offset = 0, $limit = 100) {
            $result = null;

            switch ($this->db->type) {
                case \Framework\Core\Database\DatabaseType::MYSQL:
                    $search = $this->db->generate_sql_filter($filter, true);

                    $sth = $this->db->con->prepare(
                        'SELECT SQL_CALC_FOUND_ROWS
                            `' . $this->db->prefix . 'accounts`.*,
                            `' . $this->db->prefix . 'accounts_data`.`name1`,
                            `' . $this->db->prefix . 'accounts_data`.`name2`,
                            `' . $this->db->prefix . 'accounts_data`.`name3`
                        FROM
                            `' . $this->db->prefix . 'accounts`,
                            `' . $this->db->prefix . 'accounts_data`
                        WHERE
                            `' . $this->db->prefix . 'accounts`.`id` = `' . $this->db->prefix . 'accounts_data`.`account`'
                        . $search . 'LIMIT ' . $offset . ',' . $limit
                    );
                    $sth->execute();

                    $result['list'] = $sth->fetchAll();

                    $sth = $this->db->con->prepare(
                        'SELECT FOUND_ROWS();'
                    );
                    $sth->execute();

                    $result['count'] = $sth->fetchAll()[0][0];
                    break;
            }

            return $result;
        }

        public function instantiate() {}
        public function get_object() {}
    }
}