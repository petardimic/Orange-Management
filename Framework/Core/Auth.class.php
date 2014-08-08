<?php
namespace Framework\Core {
    class Auth implements \Framework\Base\Singleton {
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
            $this->db    = \Framework\Core\Database\Database::getInstance();
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

        public function login() {
        }

        public function logout() {
        }
    }
}