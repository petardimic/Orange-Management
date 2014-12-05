<?php
namespace Modules\Sales {
    /**
     * Sales class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Handler extends \Framework\Module\ModuleAbstract implements \Framework\Module\WebInterface {
        /**
         * Providing
         *
         * @var string
         * @since 1.0.0
         */
        public static $providing = [
            'Content',
            1004400000
        ];

        /**
         * Dependencies
         *
         * @var string
         * @since 1.0.0
         */
        public static $dependencies = [
        ];

        /**
         * Constructor
         *
         * @param string                    $theme_path
         * @param \Framework\WebApplication $app Application reference
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app, $theme_path) {
            parent::__construct($app, $theme_path);
        }

        /**
         * Get modules this module is providing for
         *
         * @return array Providing
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getProviding() {
            return self::$providing;
        }

        /**
         * Get dependencies for this module
         *
         * @return array Dependencies
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getDependencies() {
            return self::$dependencies;
        }

        /**
         * Shows module content
         *
         * @para   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function callWeb() {
            switch($this->app->request->getType()) {
                case \Framework\Request\WebRequestPage::BACKEND:
                    $this->show_content_backend();
                    break;
            }
        }

        public function show_content_backend() {
            switch($this->app->request->request['l3']) {
                case 'client':
                    $this->show_backend_client();
                    break;
                case 'invoice':
                    $this->show_backend_invoice();
                    break;
                case 'article':
                    $this->show_backend_article();
                    break;
                case 'analysis':
                    $this->show_backend_analysis();
                    break;
            }
        }

        public function show_backend_article() {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->theme_path . '/backend/article-list.tpl.php';
                    break;
                case 'single':
                    $this->show_backend_client_single();
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->theme_path . '/backend/article-create.tpl.php';
                    break;
            }
        }

        public function show_backend_invoice() {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->theme_path . '/backend/invoice-list.tpl.php';
                    break;
                case 'single':
                    $this->show_backend_client_single();
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->theme_path . '/backend/invoice-create.tpl.php';
                    break;
            }
        }

        public function show_backend_client() {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->theme_path . '/backend/clients-list.tpl.php';
                    break;
                case 'single':
                    $this->show_backend_client_single();
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->theme_path . '/backend/clients-create.tpl.php';
                    break;
            }
        }

        public function show_backend_client_single() {
            switch($this->app->request->request['l5']) {
                case 'front':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->theme_path . '/backend/clients-single.tpl.php';
                    break;
            }
        }

        public function show_backend_analysis() {
            switch($this->app->request->request['l4']) {
                case 'dashboard':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->theme_path . '/backend/analysis-dashboard.tpl.php';
                    break;
            }
        }
    }
}