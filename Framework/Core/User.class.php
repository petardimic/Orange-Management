<?php
namespace Framework\Core {
    /**
     * User type enum
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
    abstract class UserType extends \Framework\Base\Enum {
        const PERSON = 0;
        const ORGANIZATION = 1;
        const COMPANY = 2;
        const GROUP = 3;
    }

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
    class User implements \Framework\Core\ObjectInterface, \Framework\Base\Multition {
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
        public $name = null;

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
         * @var int
         * @since 1.0.0
         */
        public $status = null;

        /**
         * User type
         *
         * @var int
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
         * User permissions
         *
         * @var int[]
         * @since 1.0.0
         */
        public $perm = [];

        /**
         * User groups
         *
         * @var \Framework\Core\Group[]
         * @since 1.0.0
         */
        public $groups = [];

        /**
         * Database
         *
         * @var \Framework\Core\Database
         * @since 1.0.0
         */
        private $db = null;

        /**
         * Cache
         *
         * @var \Framework\Core\Cache
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
         * @var \Framework\Core\User[]
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
            $this->db    = \Framework\Core\Database::getInstance();
            $this->cache = Cache::getInstance();

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
         * @return \Framework\Core\User
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($id, $is_current = false) {
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
                        case 1:

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

        public function create() {
            $date = new \DateTime("NOW");

            switch ($this->db->type) {
                case \Framework\Core\DatabaseType::MYSQL:
                    $this->db->con->beginTransaction();

                    $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts` (`id`, `status`, `type`, `lactive`, `created`, `changed`) VALUES
                            (1, 0, 0, \'0000-00-00 00:00:00\', \'' . $date->format('Y-m-d H:i:s') . '\', 1);'
                    )->execute();

                    $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts_data` (`id`, `login`, `name1`, `name2`, `name3`, `password`, `email`, `tries`, `account`) VALUES
                            (1, \'admin\', \'Cherry\', \'Orange\', \'Orange Management\', \'yellowOrange\', \'admin@email.com\', 5, 1);'
                    )->execute();

                    $this->db->con->prepare(
                        'INSERT INTO `' . $this->db->prefix . 'accounts_groups` (`id`, `group`, `account`) VALUES
                            (1, 1000101000, 1)'
                    )->execute();

                    $this->db->con->commit();
                    break;
            }
        }

        public function delete() {}

        public function edit() {}

        public function serialize() {}
        public function unserialize($serialized) {}
    }
}
