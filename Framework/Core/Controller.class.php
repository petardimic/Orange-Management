<?php
namespace Framework\Core {
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
    class Controller implements \Framework\Base\Singleton {
        /**
         * Database object
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
         * Request instance
         *
         * @var \Framework\Core\Request\Request
         * @since 1.0.0
         */
        public $request = null;

        /**
         * Settings instance
         *
         * @var \Framework\Core\Settings
         * @since 1.0.0
         */
        public $settings = null;

        /**
         * Modules instance
         *
         * @var \Framework\Modules\Modules
         * @since 1.0.0
         */
        public $modules = null;

        /**
         * Auth instance
         *
         * @var \Framework\Core\Auth
         * @since 1.0.0
         */
        private $auth = null;

        /**
         * User instance
         *
         * @var \Framework\Core\User
         * @since 1.0.0
         */
        private $user = null;

        /**
         * Instance
         *
         * @var \Framework\Core\Cache
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
            $this->request = \Framework\Core\Request\Request::getInstance();

            if (!$this->request->request_type !== \Framework\Core\Request\RequestPage::STATICP) {
                $this->db         = \Framework\Core\Database\Database::getInstance($dbdata);
                $this->cache      = Cache::getInstance();
                $this->settings   = Settings::getInstance();
                $this->modules    = \Framework\Modules\Modules::getInstance();
                $this->auth       = \Framework\Core\Auth::getInstance();
                $this->user       = $this->auth->authenticate($page[1]);

                Model::set_content('page:addr:url', 'http://' . $page[0]);
                Model::set_content('page:addr:local', $page[0]);
                Model::set_content('page:addr:remote', $page[1]);

                $this->modules->modules_load();
            }
        }

        /**
         * Returns instance
         *
         * @param array $dbdata DB data used for connection
         * @param array $page   Page data
         *
         * @return \Framework\Core\Controller
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
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

        /**
         * Show view
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function load() {
            switch ($this->request->request_type) {
                case \Framework\Core\Request\RequestPage::WEBSITE:
                    header('Content-Type: text/html; charset=utf-8');
                    break;
                case \Framework\Core\Request\RequestPage::BACKEND:
                    header('Content-Type: text/html; charset=utf-8');
                    $this->settings->settings_load([
                        1000000009,
                        1000000011,
                        1000000020,
                        1000000021,
                        1000000022
                    ]);

                    Model::set_content('core:oname', $this->settings->config[1000000009]);
                    Model::set_content('theme:path', $this->settings->config[1000000011]);
                    Model::set_content('core:layout', $this->request->request_type);
                    Model::set_content('page:title', 'Orange Management');

                    Model::set_content('core:language', $this->settings->config[1000000020]);
                    Model::set_content('core:timezone', $this->settings->config[1000000021]);
                    Model::set_content('core:timeformat', $this->settings->config[1000000022]);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '\..\..\Content\Themes' . $this->settings->config[1000000011] . '\backend.tpl.php';
                    break;
                case \Framework\Core\Request\RequestPage::API:
                    header('Content-Type: application/json; charset=utf-8');
                    $this->modules->running[1004400000]->show();
                    break;
                case \Framework\Core\Request\RequestPage::SHOP:
                    break;
            }
        }
    }
}