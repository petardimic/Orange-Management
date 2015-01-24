<?php
namespace Modules\Profile\Models {
    /**
     * Profile class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Profile
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class ProfileList
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

                    $sth = $this->db->con->prepare(
                        'SELECT
                            `' . $this->db->prefix . 'accounts`.*,
                            `' . $this->db->prefix . 'accounts_data`.`name1`,
                            `' . $this->db->prefix . 'accounts_data`.`name2`,
                            `' . $this->db->prefix . 'accounts_data`.`name3`
                        FROM
                            `' . $this->db->prefix . 'accounts`
                        LEFT JOIN `' . $this->db->prefix . 'accounts_data`
                        ON `' . $this->db->prefix . 'accounts`.`id` = `' . $this->db->prefix . 'accounts_data`.`account`
                        GROUP BY `' . $this->db->prefix . 'accounts`.`id` '
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
    }
}