<?php
namespace Modules\Admin\Models;
    /**
     * Groups class
     *
     * PHP Version 5.4
     *
     * @category   Module
     * @package    Admin
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class GroupList
    {
        /**
         * Database instance
         *
         * @var \Framework\DataStorage\Database\Database
         * @since 1.0.0
         */
        private $db = null;

        /**
         * Constructor
         *
         * @param \Framework\DataStorage\Database\Database $db Database instance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($db)
        {
            $this->db = $db;
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
        public function getList($filter = null, $offset = 0, $limit = 100)
        {
            $result = null;

            switch($this->db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $search = $this->db->generate_sql_filter($filter);

                    $sth = $this->db->con->prepare('SELECT SQL_CALC_FOUND_ROWS * FROM `' . $this->db->prefix . 'groups` ' . $search . 'LIMIT ' . $offset . ',' . $limit);
                    $sth->execute();

                    $result['list'] = $sth->fetchAll();

                    $sth = $this->db->con->prepare('SELECT FOUND_ROWS();');
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
        public function addGroup($name, $desc, $perm)
        {
        }

        /**
         * Delete account
         *
         * @param int $id ID of the group
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function removeGroup($id)
        {
        }
    }