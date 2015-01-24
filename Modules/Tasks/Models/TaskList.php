<?php
namespace Modules\Tasks\Models;
    /**
     * Task list class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Tasks
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class TaskList
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
        public function getList($filter = null, $offset = 0, $limit = 100)
        {
            $result = null;

            switch($this->db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $search = $this->db->generate_sql_filter($filter, true);

                    $sth = $this->db->con->prepare('SELECT
                            `' . $this->db->prefix . 'tasks`.*, `' . $this->db->prefix . 'tasks_element`.`forwarded`
                        FROM
                            `' . $this->db->prefix . 'tasks`
                        LEFT JOIN `' . $this->db->prefix . 'tasks_element`
                        ON `' . $this->db->prefix . 'tasks`.`TaskID` = `' . $this->db->prefix . 'tasks_element`.`task`
                        AND `' . $this->db->prefix . 'tasks_element`.`forwarded` = 1
                        GROUP BY `' . $this->db->prefix . 'tasks`.`TaskID` ' . $search . 'LIMIT ' . $offset . ',' . $limit);
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
         * Get task stats
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getStats()
        {
        }
    }