<?php
namespace Framework\DataStorage\Database\Objects\User {
    /**
     * User class
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
    class User implements \Framework\DataStorage\Database\Objects\ObjectInterface, \Framework\Pattern\Multition {
        /**
         * User ID
         *
         * @var int
         * @since 1.0.0
         */
        public $id = 0;

        /**
         * User name
         *
         * @var string[]
         * @since 1.0.0
         */
        public $name = ['','',''];

        /**
         * User email
         *
         * @var string
         * @since 1.0.0
         */
        public $email = null;

        /**
         * User status
         *
         * @var \Framework\DataStorage\Database\Objects\User\UserStatus
         * @since 1.0.0
         */
        public $status = null;

        /**
         * User password
         *
         * This is never initialized with any value unless a user password is reset, changed or a user gets created
         *
         * @var int
         * @since 1.0.0
         */
        public $password = null;

        /**
         * User type
         *
         * @var \Framework\DataStorage\Database\Objects\UserUserType
         * @since 1.0.0
         */
        public $type = null;

        /**
         * User created
         *
         * @var \Datetime
         * @since 1.0.0
         */
        public $created = null;

        /**
         * Users last activity
         *
         * @var \Datetime
         * @since 1.0.0
         */
        public $last_activity = null;

        /**
         * User login name
         *
         * @var string
         * @since 1.0.0
         */
        public $login_name = null;

        /**
         * Tries
         *
         * @var int
         * @since 1.0.0
         */
        public $tries = null;

        /**
         * User permissions
         *
         * @var int[]
         * @since 1.0.0
         */
        public $perm = [];

        /**
         * User groups
         *
         * @var \Framewrok\DataStorage\Database\Objects\Group\Group[]
         * @since 1.0.0
         */
        public $groups = [];

        /**
         * Database
         *
         * @var \Framework\DataStorage\Database\Database
         * @since 1.0.0
         */
        private $db = null;

        /**
         * Cache
         *
         * @var \Framework\DataStorage\Cache\Cache
         * @since 1.0.0
         */
        private $cache = null;

        /**
         * Localization instance
         *
         * @var \Framework\Localization\Localization
         * @since 1.0.0
         */
        public $loc_user = null;

        /**
         * Instances
         *
         * @var \Framework\DataStorage\Database\Objects\User\User[]
         * @since 1.0.0
         */
        protected static $instances = [];

        /**
         * Constructor
         *
         * @param int $id User ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($id) {
            $this->id    = $id;
            $this->db    = \Framework\DataStorage\Database\Database::getInstance();
            $this->cache = \Framework\DataStorage\Cache\Cache::getInstance();

            $user = $this->cache->pull('usr:' . $this->id);

            if (!$user && $id !== -1) {
                $sth = $this->db->con->prepare(
                    'SELECT
                        `' . $this->db->prefix . 'accounts`.*,
                                `' . $this->db->prefix . 'accounts_data`.*,
                                `' . $this->db->prefix . 'accounts`.`id`
                            FROM
                                `' . $this->db->prefix . 'accounts`,
                                `' . $this->db->prefix . 'accounts_data`
                            WHERE
                                `' . $this->db->prefix . 'accounts`.`id` = :id AND
                                `' . $this->db->prefix . 'accounts`.`id` = `' . $this->db->prefix . 'accounts_data`.`account`');
                $sth->bindValue(':id', $this->id, \PDO::PARAM_INT);
                $sth->execute();
                $user = $sth->fetchAll(\PDO::FETCH_UNIQUE);

                if (!empty($user)) {
                    $this->cache->push('usr:' . $id, $user);
                }
            }

            if (!empty($user)) {
                $this->status        = (int)$user[$id]['status'];
                $this->type          = (int)$user[$id]['type'];
                $this->created       = $user[$id]['created'];
                $this->login_name    = $user[$id]['login'];
                $this->last_activity = $user[$id]['lactive'];
                $this->name          = [$user[$id]['name1'], $user[$id]['name2'], $user[$id]['name3']];
                $this->email         = $user[$id]['email'];
            }
        }

        /**
         * Returns instance
         *
         * @param int  $id         User ID
         * @param bool $is_current User ID is current user
         *
         * @return \Framework\DataStorage\Database\Objects\User\User
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($id, $is_current = false) {
            /* TODO: implement the cache loading right here. smart idea! */
            if (!isset(self::$instances[$id])) {
                self::$instances[$id] = new self($id);

                if ($is_current) {
                    self::$instances[-1] = & self::$instances[$id];
                }
            }

            return self::$instances[$id];
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
         * Get user permissions
         *
         * @return array Permission array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function account_permission_get() {
            if (!isset($this->perm)) {
                $this->perm = $this->cache->pull('usr:perm:' . $this->id);

                if (!$this->perm) {
                    switch ($this->db->type) {
                        case \Framework\DataStorage\Database\DatabaseType::MYSQL:

                            break;
                    }

                    $this->cache->push('usr:perm:' . $this->id, $this->perm);
                }
            }

            return $this->perm;
        }

        /**
         * Check if user is allowed
         *
         * @param int[] $req Necessary permissions
         *
         * @return boolean
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function is_allowed($req) {
            if (!isset($this->perm)) {
                $this->account_permission_get();
            }

            foreach ($req as $val) {
                if (array_key_exists($val, $this->perm)) {
                    return true;
                }
            }

            return false;
        }

        /**
         * Edit account
         *
         * This function modifies an existing account
         *
         * @param array $account Account data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function account_edit_base($account) {
            switch ($this->db->type) {
                case 1:
                    $sth = $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts` (`login`, `password`, `email`, `changed`) VALUES
                            (:aname, :pword, :email, 1);'
                    );

                    $sth->bindValue(':aname', $account['aname'], \PDO::PARAM_STR);
                    $sth->bindValue(':pword', $account['pword'], \PDO::PARAM_STR);
                    $sth->bindValue(':email', $account['email'], \PDO::PARAM_STR);
                    $sth->execute();
                    break;
            }
        }

        /**
         * Add a group to this user
         *
         * @param int $id Group ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function add_group($id) {
            if(!array_key_exists($id, $this->groups)) {
                $this->groups[$id] = \Framewrok\DataStorage\Database\Objects\Group\Group::getInstance($id);
            }

            switch ($this->db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts_groups` (`group`, `account`) VALUES (:group, :account)'
                    );

                    $sth->bindValue(':group', $id, \PDO::PARAM_INT);
                    $sth->bindValue(':account', $this->id, \PDO::PARAM_INT);
                    $sth->execute();
                    break;
            }
        }

        /**
         * Creating this object as dataset
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function create() {
            $date = new \DateTime("NOW", new \DateTimeZone('UTC'));

            switch ($this->db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts` (`status`, `type`, `lactive`, `created`, `changed`) VALUES
                            (:status, :type, \'0000-00-00 00:00:00\', \'' . $date->format('Y-m-d H:i:s') . '\', 1);'
                    );

                    $sth->bindValue(':status', $this->status, \PDO::PARAM_INT);
                    $sth->bindValue(':type', $this->type, \PDO::PARAM_INT);
                    $sth->execute();

                    $this->id = $this->db->con->lastInsertId();

                    $this->db->con->beginTransaction();
                    $sth = $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts_data` (`login`, `name1`, `name2`, `name3`, `password`, `email`, `tries`, `account`) VALUES
                            (:login, :name1, :name2, :name3, :passowrd, :email, 5, :account);'
                    );

                    $sth->bindValue(':login', $this->login_name, \PDO::PARAM_STR);
                    $sth->bindValue(':name1', $this->name[0], \PDO::PARAM_STR);
                    $sth->bindValue(':name2', $this->name[1], \PDO::PARAM_STR);
                    $sth->bindValue(':name3', $this->name[2], \PDO::PARAM_STR);
                    $sth->bindValue(':password', $this->password, \PDO::PARAM_STR);
                    $sth->bindValue(':email', $this->email, \PDO::PARAM_STR);
                    $sth->bindValue(':account', $this->id, \PDO::PARAM_INT);

                    $group_string = '';
                    foreach($this->groups as $key => $value) {
                        $group_string .= '(' . $value->id . ', ' . $this->id . '),';
                    }
                    $group_string = rtrim($group_string, ',');

                    $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts_groups` (`group`, `account`) VALUES ' . $group_string
                    );
                    $this->db->con->commit();
                    break;
            }
        }

        /**
         * Deleting this object from the database
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function delete() {
            /* TODO: call all installed modules user_delete function */

            $sth = $this->db->con->prepare(
                'DELETE `' . $this->db->prefix . 'accounts_groups` WHERE `account` = ' . $this->id
            );

            $sth->execute();

            $sth = $this->db->con->prepare(
                'DELETE `' . $this->db->prefix . 'accounts_data` WHERE `account` = ' . $this->id
            );

            $sth->execute();

            $sth = $this->db->con->prepare(
                'DELETE `' . $this->db->prefix . 'accounts` WHERE `id` = ' . $this->id
            );

            $sth->execute();
        }

        /**
         * Editing the database object
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function edit() {
            $sth = $this->db->con->prepare(
                'UPDATE `' . $this->db->prefix . 'accounts` SET `status` = :status, `type` = :type, `changed` = 1 WHERE `id` = ' . $this->id . ';'
            );

            $sth->execute();

            $sth = $this->db->con->prepare(
                'UPDATE `' . $this->db->prefix . 'accounts_data` SET `login` = :login, `name1` = :name1, `name2` = :name2, `name3` = :name3, `password` = :password, `email` = :email, `tries` = :tries WHERE `id` = ' . $this->id . ';'
            );

            $sth->bindValue(':login', $this->login_name, \PDO::PARAM_STR);
            $sth->bindValue(':name1', $this->name[0], \PDO::PARAM_STR);
            $sth->bindValue(':name2', $this->name[1], \PDO::PARAM_STR);
            $sth->bindValue(':name3', $this->name[2], \PDO::PARAM_STR);
            $sth->bindValue(':password', $this->password, \PDO::PARAM_STR);
            $sth->bindValue(':email', $this->email, \PDO::PARAM_STR);
            $sth->execute();

            /* TODO: In case of caching is implemented, overwrite the cache */
        }

        /**
         * Serialize this object
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function serialize() {
            $toSerialize = [
                'name' => $this->name,
                'login_name' => $this->login_name,
                'id' => $this->id,
                'email' => $this->email,
                'status' => $this->status,
                'type' => $this->created,
                'last_activity' => $this->last_activity,
                'created' => $this->created,
                'tries' => $this->tries,
                'groups' => $this->groups /* only ids */
            ];

            return json_encode($toSearialize);
        }

        /**
         * Initialize this object from serialization
         *
         * @param array $serialized Serialized data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function unserialize($serialized) {
            $plain = json_decode($serialized, true);

            $this->name = $plain['name'];
            $this->login_name = $plain['login_name'];
            $this->id = $plain['id'];
            $this->email = $plain['email'];
            $this->status = $plain['status'];
            $this->type = $plain['type'];
            $this->last_activty = $plain['last_activity'];
            $this->created = $plain['created'];
            $this->tries = $plain['tries'];
            $this->groups = $plain['groups']; /* TODO: This is wrong... check this later */
        }
    }
}