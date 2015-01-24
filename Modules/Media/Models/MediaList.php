<?php
namespace Modules\Media\Models;
    /**
     * Media list class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Modules\Media
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class MediaList
    {
        private $db = null;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function getList($filter = null, $offset = 0, $limit = 100)
        {
            $result = null;

            switch($this->db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $search = $this->db->generate_sql_filter($filter, true);

                    // SQL_CALC_FOUND_ROWS
                    $sth = $this->db->con->prepare(
                        'SELECT 
                            `' . $this->db->prefix . 'media`.*,
                            `' . $this->db->prefix . 'accounts_data`.`name1`,
                            `' . $this->db->prefix . 'accounts_data`.`name2`,
                            `' . $this->db->prefix . 'accounts_data`.`name3`
                        FROM
                            `' . $this->db->prefix . 'media`
                        LEFT JOIN `' . $this->db->prefix . 'accounts_data`
                        ON `' . $this->db->prefix . 'media`.`creator` = `' . $this->db->prefix . 'accounts_data`.`account`
                        GROUP BY `' . $this->db->prefix . 'media`.`media_id` '
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