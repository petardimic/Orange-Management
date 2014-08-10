<?php
namespace Framework\Core {
    /**
     * Group class
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
    class Group implements \Framework\Core\Database\ObjectInterface, \Framework\Base\Multition, \Serializable {
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
         * Group ID
         *
         * @var int
         * @since 1.0.0
         */
        public $id = null;

        /**
         * Instances
         *
         * @var \Framework\Core\Group[]
         * @since 1.0.0
         */
        protected static $instance = [];

        /**
         * Group description
         *
         * @var string
         * @since 1.0.0
         */
        public $desc = null;

        /**
         * Group name
         *
         * @var string
         * @since 1.0.0
         */
        public $name = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($id) {
            $this->id    = $id;
            $this->db    = \Framework\Core\Database\Database::getInstance();
            $this->cache = Cache::getInstance();

            $sth = $this->db->con->prepare(
                'SELECT * FROM `' . $this->db->prefix . 'groups` WHERE id = :id'
            );
            $sth->bindValue(':id', $id, \PDO::PARAM_INT);
            $sth->execute();

            $group = $sth->fetchAll()[0];
            $this->name = $group['name'];
            $this->desc = $group['desc'];
        }

        /**
         * Returns instance
         *
         * @param int $id Group ID
         *
         * @return \Framework\Core\Group
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($id) {
            if (!isset(self::$instance[$id])) {
                self::$instance[$id] = new self($id);
            }

            return self::$instance[$id];
        }

        /**
         * Protect instance from getting copied from outside
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        protected function __clone() {
        }

        public function permission_exists() {

        }

        public function create() {}
        public function delete() {}

        public function serialize() {}
        public function unserialize($serialized) {}
    }
}