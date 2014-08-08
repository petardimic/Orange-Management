<?php
namespace Modules\Admin {
    /**
     * Groups class
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
    class Groups implements \Framework\Core\Database\ObjectListInterface, \Framework\Base\Singleton {
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
         * @var \Modules\Admin\Groups
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
         * @return \Modules\Admin\Groups
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
         * Get all groups
         *
         * This function gets all groups in a range
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
        public function group_list_get($filter = null, $offset = 0, $limit = 100) {
            $result = null;

            switch ($this->db->type) {
                case \Framework\Core\Database\DatabaseType::MYSQL:
                    $search = $this->db->generate_sql_filter($filter);

                    $sth = $this->db->con->prepare(
                        'SELECT SQL_CALC_FOUND_ROWS * FROM `' . $this->db->prefix . 'groups` ' . $search . 'LIMIT ' . $offset . ',' . $limit
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

        /**
         * Create a group
         *
         * @param string $name Name of the group
         * @param string $desc Description of the group
         * @param int[]  $perm Permissions of the group
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function group_create($name, $desc, $perm) {
        }

        /**
         * Delete account
         *
         * param int $id ID of the group
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function group_delete($id) {
        }

        /**
         * Create a group
         *
         * @param int    $id   ID of the group
         * @param string $name Name of the group
         * @param string $desc Description of the group
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function group_edit($id, $name, $desc) {
        }

        public function instantiate() {}
        public function get_object() {}
    }
}