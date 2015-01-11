<?php
namespace Framework\Object\Group {
    /**
     * Group class
     *
     * PHP Version 5.4
     *
     * @category   Object
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Group implements \Framework\Object\MapperInterface, \Framework\Pattern\Multition
    {
        /**
         * Application instance
         *
         * @var \Framework\WebApplication
         * @since 1.0.0
         */
        private $app = null;

        /**
         * Group ID
         *
         * @var int
         * @since 1.0.0
         */
        public $id = null;

        /**
         * Permissions
         *
         * @var int[]
         * @since 1.0.0
         */
        public $permissions = [];

        /**
         * Instances
         *
         * @var \Framework\Object\Group\Group[]
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
        public function __construct()
        {
        }

        /**
         * Initializing a group
         *
         * @param int $id ID to initialize
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function init($id)
        {
            $this->id = (int) $id;

            $sth = $this->app->db->con->prepare(
                'SELECT * FROM `' . $this->app->db->prefix . 'groups` WHERE id = :id'
            );

            $sth->bindValue(':id', $id, \PDO::PARAM_INT);
            $sth->execute();

            $group      = $sth->fetchAll()[0];
            $this->name = $group['name'];
            $this->desc = $group['desc'];
        }

        /**
         * Returns instance
         *
         * @param int $id Group ID
         *
         * @return \Framework\Object\Group\Group
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($id)
        {
            /* TODO: Implement caching here */
            if(!isset(self::$instance[$id])) {
                self::$instance[$id] = new self();
                self::$instance[$id]->init($id);
            }

            return self::$instance[$id];
        }

        /**
         * Protect instance from getting copied from outside
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __clone()
        {
        }

        /**
         * Checking if any permission exists
         *
         * @param int[] $permissions Permissions
         *
         * @return boolean
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function permission_exists($permissions)
        {
            foreach($permissions as $permission) {
                if(array_key_exists($permission, $this->permissions)) {
                    return true;
                }
            }

            return false;
        }

        /**
         * Creating this object as dataset
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function create()
        {
            switch($this->app->db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->app->db->con->prepare(
                        'INSERT INTO `' . $this->app->db->prefix . 'groups` (`name`, `desc`) VALUES
                            (:name, :desc);'
                    );

                    $sth->bindValue(':name', $this->name, \PDO::PARAM_STR);
                    $sth->bindValue(':desc', $this->desc, \PDO::PARAM_STR);
                    $sth->execute();

                    $this->id = $this->app->db->con->lastInsertId();

                    break;
            }
        }

        /**
         * Deleting this object from the database
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function delete()
        {
            /* TODO: delete permissions */
            $sth = $this->app->db->con->prepare(
                'DELETE `' . $this->app->db->prefix . 'accounts_groups` WHERE `group` = ' . $this->id
            );

            $sth->execute();

            $sth = $this->app->db->con->prepare(
                'DELETE `' . $this->app->db->prefix . 'groups` WHERE `id` = ' . $this->id
            );

            $sth->execute();
        }

        /**
         * Editing the database object
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function update()
        {
            switch($this->app->db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->app->db->con->prepare(
                        'UPDATE `' . $this->app->db->prefix . 'groups` SET `name` = :name, `desc` = :desc WHERE `id` = ' . $this->id . ';'
                    );

                    $sth->bindValue(':name', $this->name, \PDO::PARAM_STR);
                    $sth->bindValue(':desc', $this->desc, \PDO::PARAM_STR);
                    $sth->execute();

                    break;
            }
        }

        /**
         * Serialize this object
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function serialize()
        {
            $toSerialize = [
                'id'          => $this->id,
                'name'        => $this->name,
                'desc'        => $this->desc,
                'permissions' => $this->permissions
            ];

            return json_encode($toSerialize);
        }

        /**
         * Initialize this object from serialization
         *
         * @param array $serialized Serialized data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function unserialize($serialized)
        {
            $plain = json_decode($serialized, true);

            $this->id          = $plain['id'];
            $this->name        = $plain['name'];
            $this->desc        = $plain['desc'];
            $this->permissions = $plain['permission'];
        }
    }
}
