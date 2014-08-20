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
         * @var \Framework\Http\Request
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
        public $user = null;

        /**
         * Theme controller
         *
         * @var \Content\Theme
         * @since 1.0.0
         */
        private $theme = null;

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
            $this->request = new \Framework\Http\Request();
            $this->db      = new \Framework\DataStorage\Database\Database($dbdata);

            \Framework\Module\ModuleFactory::$app = $this;
            \Framework\Model\Model::$app          = $this;

            if ($this->db->status === \Framework\DataStorage\Database\DatabaseStatus::OK) {
                $this->cache    = new \Framework\DataStorage\Cache\Cache($this);
                $this->settings = new \Framework\Config\Settings($this);
                $this->modules  = new \Framework\Module\Modules($this);
                $this->auth     = new \Framework\Auth\Auth($this);
                $this->user     = $this->auth->authenticate($page[1]);

                $this->settings->load_settings([1000000011]);

                \Framework\Model\Model::$content['page:addr:url']    = 'http://' . $page[0];
                \Framework\Model\Model::$content['page:addr:local']  = 'http://' . $page[0];
                \Framework\Model\Model::$content['page:addr:remote'] = 'http://' . $page[1];

                include __DIR__ . '/../Content/Themes' . $this->settings->config[1000000011] . '/Theme.class.php';
                $this->theme = new \Content\Theme($this);
            } else {
                header('HTTP/1.0 503 Service Temporarily Unavailable');
                header('Status: 503 Service Temporarily Unavailable');
                header('Retry-After: 300');
                include __DIR__ . '/../Content/Error/503.php';
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
