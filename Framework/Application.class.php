<?php
namespace Framework {
    /**
     * Controller class
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
    class Application implements \Framework\Pattern\Singleton {
        /**
         * Database object
         *
         * @var \Framework\DataStorage\Database\Database
         * @since 1.0.0
         */
        public $db = null;

        /**
         * Cache instance
         *
         * @var \Framework\DataStorage\Cache\Cache
         * @since 1.0.0
         */
        public $cache = null;

        /**
         * Request instance
         *
         * @var \Framework\Request\Request
         * @since 1.0.0
         */
        public $request = null;

        /**
         * Settings instance
         *
         * @var \Framework\Config\Settings
         * @since 1.0.0
         */
        public $settings = null;

        /**
         * Modules instance
         *
         * @var \Framework\Module\Modules
         * @since 1.0.0
         */
        public $modules = null;

        /**
         * Auth instance
         *
         * @var \Framework\Auth\Auth
         * @since 1.0.0
         */
        private $auth = null;

        /**
         * User instance
         *
         * @var \Framework\DataStorage\Database\Objects\User\User
         * @since 1.0.0
         */
        private $user = null;

        /**
         * Instance
         *
         * @var \Framework\DataStorage\Cache\Cache
         * @since 1.0.0
         */
        protected static $instance = null;

        /**
         * Constructor
         *
         * @param array $dbdata DB data used for connection
         * @param array $page   Page data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function __construct($dbdata = null, $page = null) {
            $this->request = \Framework\Request\Request::getInstance();

            $this->db = \Framework\DataStorage\Database\Database::getInstance($dbdata);

            /* TODO: NEEDS better error handling here and further down... maybe create header error handler */
            if ($this->db->status === \Framework\DataStorage\Database\DatabaseStatus::OK) {
                $this->cache    = \Framework\DataStorage\Cache\Cache::getInstance();
                $this->settings = \Framework\Config\Settings::getInstance();
                $this->modules  = \Framework\Module\Modules::getInstance();
                $this->auth     = \Framework\Auth\Auth::getInstance();
                $this->user     = $this->auth->authenticate($page[1]);

                \Framework\Model\Model::set_content('page:addr:url', 'http://' . $page[0]);
                \Framework\Model\Model::set_content('page:addr:local', $page[0]);
                \Framework\Model\Model::set_content('page:addr:remote', $page[1]);

                $this->modules->modules_load();

                $this->settings->settings_load([
                    1000000011,
                ]);

                require __DIR__ . '\..\Content\Themes' . $this->settings->config[1000000011] . '\ThemeController.class.php';
                $theme = new \Framework\Controller\ThemeController($this);
                $theme->load();
            }
        }

        /**
         * Returns instance
         *
         * @param array $dbdata DB data used for connection
         * @param array $page   Page data
         *
         * @return \Framework\Controller\Controller
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
         /* TODO: This shouldn't be a singleton ?!?!? */
        public static function getInstance($dbdata = null, $page = null) {
            if (self::$instance === null) {
                self::$instance = new self($dbdata, $page);
            }

            return self::$instance;
        }

        /**
         * Protect instance from getting copied from outside
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        protected function __clone() {
        }
    }
}
