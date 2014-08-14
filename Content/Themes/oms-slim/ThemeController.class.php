<?php
namespace Framework\Controller {
    /**
     * Request page enum
     *
     * This is just an example in order to show how designers can extend the possible sub-pages
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
    abstract class ThemeRequestPage extends \Framework\Request\RequestPage {
        const CREDIT = 'credit';
    }

    class ThemeController {
        /**
         * Application instance
         *
         * @var \Framework\Application
         * @since 1.0.0
         */
        private $app = null;

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
            $this->app->modules->modules_load($this->app);

            switch ($this->app->request->request_type) {
                case \Framework\Request\RequestPage::BACKEND:
                header('Content-Type: text/html; charset=utf-8');

                $this->app->settings->load_settings([1000000009]);

                \Framework\Model\Model::set_content(
                    [
                        'core:oname' => $this->app->settings->config[1000000009],
                        'theme:path' =>  $this->app->settings->config[1000000011], 
                        'core:layout' => $this->app->request->request_type,
                        'page:title' => 'Orange Management'
                    ]
                );

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '\backend.tpl.php';
                break;
                case \Framework\Request\RequestPage::API:
                header('Content-Type: application/json; charset=utf-8');

                $this->app->modules->running[1004400000]->show();
                break;
            }
        }
    }
}