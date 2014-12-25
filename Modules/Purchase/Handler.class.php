<?php
namespace Modules\Purchase {
    /**
     * Purchase class
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
         * @param string                    $themePath
         * @param \Framework\WebApplication $app Application reference
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app, $themePath) {
            parent::__construct($app, $themePath);
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
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function callWeb() {
            switch($this->app->request->getType()) {
                case \Framework\Request\WebRequestPage::BACKEND:
                    $this->showContentBackend();
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showContentBackend() {
            switch($this->app->request->request['l3']) {
                case 'supplier':
                    $this->showBackendSupplier();
                    break;
                case 'invoice':
                    $this->showBackendInvoice();
                    break;
                case 'article':
                    $this->showBackendArticle();
                    break;
                case 'analysis':
                    $this->showBackendAnalysis();
                    break;
            }
        }

        public function showBackendArticle() {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/article-list.tpl.php';
                    break;
                case 'single':
                    $this->show_backend_client_single();
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/article-create.tpl.php';
                    break;
            }
        }

        public function showBackendInvoice() {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $invoiceList = new \Modules\Purchase\InvoiceList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/invoice-list.tpl.php';
                    break;
                case 'single':
                    $this->show_backend_client_single();
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/invoice-create.tpl.php';
                    break;
            }
        }

        public function showBackendSupplier() {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $supplierList = new \Modules\Purchase\SupplierList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/suppliers-list.tpl.php';
                    break;
                case 'single':
                    $this->show_backend_client_single();
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/suppliers-create.tpl.php';
                    break;
            }
        }

        public function show_backend_client_single() {
        }

        public function showBackendAnalysis() {
            switch($this->app->request->request['l4']) {
                case 'dashboard':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/analysis-dashboard.tpl.php';
                    break;
            }
        }
    }
}