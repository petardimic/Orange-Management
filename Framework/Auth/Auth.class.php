<?php
namespace Framework\Auth {
    /**
     * Auth class
     *
     * Responsible for authenticating and initializing the connection
     *
     * PHP Version 5.4
     *
     * @category   Auth
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Auth implements \Framework\Config\OptionsInterface {
        /**
         * Application instance
         *
         * @var \Framework\WebApplication
         * @since 1.0.0
         */
        private $app = null;

        /**
         * Options
         *
         * @var array
         * @since 1.0.0
         */
        private $options = [];

        /**
         * Constructor
         *
         * @param \Framework\WebApplication $app Application reference
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app) {
            $this->app = $app;
        }

        /**
         * Authenticates user
         *
         * @param string $page Page address
         *
         * @return \Framework\DataStorage\Database\Objects\User\User
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function authenticate() {
            $uid = $this->app->session->getValue('user_id');

            if ($uid !== null) {
                return \Framework\DataStorage\Database\Objects\User\User::getInstance($uid, $this->app, true);
            } else {
                return null;
            }
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
            // TODO: get password from db based on $username which is = loginname which can be email or number or name

            // TODO: save to session
            // TODO: reload page
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

        /**
         * Get option by key
         *
         * @param mixed $key Unique option key
         *
         * @return mixed Option value
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function get_option($key) {
            return (isset($this->options[$key]) ? $this->options[$key] : null);
        }

        /**
         * Updating or adding settings
         *
         * @param mixed $key      Unique option key
         * @param mixed $value    Option value
         * @param bool  $storable Is this option storable inside DB or cache
         * @param bool  $save     Should this update the database/cache
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function set_option($key, $value, $storable = false, $save = false) {
            $this->options[$key] = [$value, $storable];

            if ($save) {
                // TODO: save to db and or caching
            }
        }

        /**
         * Update options (push them into DB and Cache)
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function update() {
        }
    }
}
