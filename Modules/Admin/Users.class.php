<?php
namespace Modules\Admin {
    /**
     * Users class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Users implements \Framework\DataStorage\Database\Objects\ObjectListInterface {
        /**
         * Application instance
         *
         * @var \Framework\WebApplication
         * @since 1.0.0
         */
        private $app = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app) {
            $this->app = $app;
        }

        /**
         * Create new account
         *
         * @param string $name  Login name
         * @param string $pass  Password
         * @param string $email Email
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function account_create($name, $pass, $email) {
            $date = new \DateTime("NOW", new \DateTimeZone('UTC'));

            switch ($this->app->db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->app->db->con->prepare(
                        'INSERT INTO `' . $this->app->db->prefix . 'accounts` (`login`, `password`, `email`, `llogin`, `tries`, `created`, `changed`) VALUES
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

            switch ($this->app->db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $search = $this->app->db->generate_sql_filter($filter, true);

                    $sth = $this->app->db->con->prepare(
                        'SELECT SQL_CALC_FOUND_ROWS
                            `' . $this->app->db->prefix . 'accounts`.*,
                            `' . $this->app->db->prefix . 'accounts_data`.`name1`,
                            `' . $this->app->db->prefix . 'accounts_data`.`name2`,
                            `' . $this->app->db->prefix . 'accounts_data`.`name3`
                        FROM
                            `' . $this->app->db->prefix . 'accounts`,
                            `' . $this->app->db->prefix . 'accounts_data`
                        WHERE
                            `' . $this->app->db->prefix . 'accounts`.`id` = `' . $this->app->db->prefix . 'accounts_data`.`account`'
                        . $search . 'LIMIT ' . $offset . ',' . $limit
                    );
                    $sth->execute();

                    $result['list'] = $sth->fetchAll();

                    $sth = $this->app->db->con->prepare(
                        'SELECT FOUND_ROWS();'
                    );
                    $sth->execute();

                    $result['count'] = $sth->fetchAll()[0][0];
                    break;
            }

            return $result;
        }

        public function instantiate() {
        }

        public function get_object() {
        }
    }
}
