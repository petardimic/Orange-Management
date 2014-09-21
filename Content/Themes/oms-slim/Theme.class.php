<?php
namespace Content {
    /**
     * Controller class
     *
     * PHP Version 5.4
     *
     * @category   Theme
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Theme {
        /**
         * Application instance
         *
         * @var \Framework\Application
         * @since 1.0.0
         */
        protected $app = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app) {
            $this->app = $app;
            $this->load();
        }

        /**
         * Show view
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function load() {
            $this->app->modules->modules_load($this);

            switch ($this->app->request->request_type) {
                case \Framework\Http\RequestPage::BACKEND:
                    header('Content-Type: text/html; charset=utf-8');

                    $this->app->settings->load_settings([1000000009]);

                    \Framework\Model\Model::$content['core:oname']  = $this->app->settings->config[1000000009];
                    \Framework\Model\Model::$content['theme:path']  = $this->app->settings->config[1000000011];
                    \Framework\Model\Model::$content['core:layout'] = $this->app->request->request_type;
                    \Framework\Model\Model::$content['page:title']  = 'Orange Management';

                    /** @noinspection PhpIncludeInspection */
                    require __DIR__ . '/backend/template.tpl.php';
                    break;
                case \Framework\Http\RequestPage::API:
                    header('Content-Type: application/json; charset=utf-8');

                    $this->app->modules->running[1004400000]->show();
                    break;
                default:
            }
        }
    }
}
