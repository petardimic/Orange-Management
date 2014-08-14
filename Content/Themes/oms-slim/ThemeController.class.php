<?php
namespace Framework\Controller {
    class ThemeController {
        private $app = null;

        public function __construct($app) {
            $this->app = $app;
        }

        /**
         * Show view
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function load() {
            switch ($this->app->request->request_type) {
                case \Framework\Request\RequestPage::BACKEND:
                    header('Content-Type: text/html; charset=utf-8');

                    /* This isn't nice, maybe fix it */
                    if ($this->app->db->status === \Framework\DataStorage\Database\DatabaseStatus::OK) {
                        $this->app->settings->settings_load([
                            1000000009,
                            1000000020,
                            1000000021,
                            1000000022
                        ]);

                        \Framework\Model\Model::set_content('core:oname', $this->app->settings->config[1000000009]);
                        \Framework\Model\Model::set_content('theme:path', $this->app->settings->config[1000000011]);
                        \Framework\Model\Model::set_content('core:layout', $this->app->request->request_type);
                        \Framework\Model\Model::set_content('page:title', 'Orange Management');

                        \Framework\Model\Model::set_content('core:language', $this->app->settings->config[1000000020]);
                        \Framework\Model\Model::set_content('core:timezone', $this->app->settings->config[1000000021]);
                        \Framework\Model\Model::set_content('core:timeformat', $this->app->settings->config[1000000022]);

                        /** @noinspection PhpIncludeInspection */
                        include __DIR__ . '\backend.tpl.php';
                    } else {
                        header('HTTP/1.0 503 Service Temporarily Unavailable');
                        header('Status: 503 Service Temporarily Unavailable');
                        header('Retry-After: 300');
                        include __DIR__ . '\..\..\..\503.php';
                    }
                    break;
                case \Framework\Request\RequestPage::API:
                    header('Content-Type: application/json; charset=utf-8');

                    $this->app->modules->running[1004400000]->show();
                    break;
                case \Framework\Request\RequestPage::SHOP:
                    break;
            }
        }
    }
}