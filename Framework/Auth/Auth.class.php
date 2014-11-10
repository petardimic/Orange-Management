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
    class Auth {
        /**
         * Application instance
         *
         * @var \Framework\WebApplication
         * @since 1.0.0
         */
        private $app = null;

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
            $uid = $this->app->session->get_value('user_id');

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
