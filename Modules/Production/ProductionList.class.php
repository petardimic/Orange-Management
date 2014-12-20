<?php
namespace Modules\Production {
    /**
     * Media list class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Modules\Production
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class ProductionList {
        private $db = null;

        public function __construct($db) {
            $this->db = $db;
        }

        public function getList($filter = null, $offset = 0, $limit = 100) {
            $result = null;

            switch($this->db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $search = $this->db->generate_sql_filter($filter, true);


                    break;
            }

            return $result;
        }
    }
}