<?php
namespace Framework\Core {
    /**
     * Login return types enum
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
    abstract class LoginReturnType extends \Framework\Base\Enum {
        const OK = 0;
        const FAILURE = 1;
        const WRONG_PASSWORD = 2;
        const WRONG_USERNAME = 3;
        const WRONG_PERMISSION = 4;
        const NOT_ACTIVATED = 5;
        const WRONG_INPUT_EXCEEDED = 6;
        const TIMEOUTED = 7;
        const BANNED = 8;
        const INACTIVE = 9;
    }

    /**
     * Auth class
     *
     * Responsible for authenticating and initializing the connection
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
    class Auth implements \Framework\Base\Singleton {
        /**
         * Database
         *
         * @var \Framework\Core\Database
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
         * Instances
         *
         * @var \Framework\Core\Auth
         * @since 1.0.0
         */
        protected static $instance = null;

        /**
         * Constructor
         *
         * @param string $page Page address
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct() {
            $this->db    = \Framework\Core\Database::getInstance();
            $this->cache = \Framework\Core\Cache::getInstance();
        }

        /**
         * Returns instance
         *
         * @return \Framework\Core\Auth
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Authenticates user
         *
         * @param string $page Page address
         *
         * @return \Framework\Core\User
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function authenticate($page) {
            return \Framework\Core\User::getInstance($this->check_session($page), true);
        }

        /**
         * Initialize user ID
         *
         * @param string $page Page address
         *
         * @return int Account ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function check_session($page) {
            session_set_cookie_params(0, '/', 'http://' . $page, false, true);
            session_start();
            $SID = (isset($_SESSION['account']) && !empty($_SESSION['account']) && $_SESSION['account']['id'] !== 0 ? $_SESSION['account'] : 0);
            session_write_close();

            return $SID;
        }

        /**
         * Login user
         *
         * @param string $username Username
         * @param string $password Password
         *
         * @return int Login code
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function login($username, $password) {
        }

        /**
         * Logout the given user
         *
         * @param int $uid User ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function logout($uid) {
        }
    }
}
