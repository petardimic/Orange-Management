<?php
namespace Modules\Profile {
    /**
     * Profile class
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
    class ProfileList {
        private $app = null;

        public function __construct($app) {
            $this->app = $app;
        }

        public function getAccountList($filter = null, $offset = 0, $limit = 100) {
            $result = null;

            switch($this->app->db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $search = $this->app->db->generate_sql_filter($filter, true);

                    $sth = $this->app->db->con->prepare(
                        'SELECT
                            `' . $this->app->db->prefix . 'accounts`.*,
                            `' . $this->app->db->prefix . 'accounts_data`.`name1`,
                            `' . $this->app->db->prefix . 'accounts_data`.`name2`,
                            `' . $this->app->db->prefix . 'accounts_data`.`name3`
                        FROM
                            `' . $this->app->db->prefix . 'accounts`
                        LEFT JOIN `' . $this->app->db->prefix . 'accounts_data`
                        ON `' . $this->app->db->prefix . 'accounts`.`id` = `' . $this->app->db->prefix . 'accounts_data`.`account`
                        GROUP BY `' . $this->app->db->prefix . 'accounts`.`id` '
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
    }
}