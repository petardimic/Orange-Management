<?php
namespace Framework\Controller {
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
    class Controller implements \Framework\Pattern\Singleton {
        /**
         * Database object
         *
         * @var \Framework\DataStorage\Database\Database
         * @since 1.0.0
         */
        private $db = null;

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

            if (!$this->request->request_type !== \Framework\Request\RequestPage::STATICP) {
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
                }
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

        /**
         * Show view
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function load() {
            switch ($this->request->request_type) {
                case \Framework\Request\RequestPage::WEBSITE:
                    header('Content-Type: text/html; charset=utf-8');
                    break;
                case \Framework\Request\RequestPage::BACKEND:
                    header('Content-Type: text/html; charset=utf-8');

                    /* This isn't nice, maybe fix it */
                    if ($this->db->status === \Framework\DataStorage\Database\DatabaseStatus::OK) {
                        $this->settings->settings_load([
                            1000000009,
                            1000000011,
                            1000000020,
                            1000000021,
                            1000000022
                        ]);

                        \Framework\Model\Model::set_content('core:oname', $this->settings->config[1000000009]);
                        \Framework\Model\Model::set_content('theme:path', $this->settings->config[1000000011]);
                        \Framework\Model\Model::set_content('core:layout', $this->request->request_type);
                        \Framework\Model\Model::set_content('page:title', 'Orange Management');

                        \Framework\Model\Model::set_content('core:language', $this->settings->config[1000000020]);
                        \Framework\Model\Model::set_content('core:timezone', $this->settings->config[1000000021]);
                        \Framework\Model\Model::set_content('core:timeformat', $this->settings->config[1000000022]);

                        /** @noinspection PhpIncludeInspection */
                        include __DIR__ . '\..\..\Content\Themes' . $this->settings->config[1000000011] . '\backend.tpl.php';
                    } else {
                        header('HTTP/1.0 503 Service Temporarily Unavailable');
                        header('Status: 503 Service Temporarily Unavailable');
                        header('Retry-After: 300');
                        include __DIR__ . '\..\..\503.php';
                    }
                    break;
                case \Framework\Request\RequestPage::API:
                    header('Content-Type: application/json; charset=utf-8');

                    $this->modules->running[1004400000]->show();
                    break;
                case \Framework\Request\RequestPage::SHOP:
                    break;
            }
        }
    }
}
