<?php
namespace Modules\Sales {
    /**
     * Sales class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Modules\Sales
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Controller extends \Framework\Module\ModuleAbstract implements \Framework\Module\WebInterface
    {
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
            'Warehousing'
        ];

        /**
         * Constructor
         *
         * @param \Framework\WebApplication $app Application reference
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app)
        {
            parent::__construct($app);
        }

        /**
         * Get modules this module is providing for
         *
         * @return array Providing
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getProviding()
        {
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
        public function getDependencies()
        {
            return self::$dependencies;
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function callWeb()
        {
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
        public function showContentBackend()
        {
            switch($this->app->request->request['l3']) {
                case 'client':
                    $this->showBackendClient();
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

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showBackendArticle()
        {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $articleList = new \Modules\Sales\Models\ArticleList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/article-list.tpl.php';
                    break;
                case 'single':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/article-single.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/article-create.tpl.php';
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showBackendInvoice()
        {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $invoiceList = new \Modules\Sales\Models\InvoiceList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/invoice-list.tpl.php';
                    break;
                case 'single':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/invoice-single.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/invoice-create.tpl.php';
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showBackendClient()
        {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $clientList = new \Modules\Sales\Models\ClientList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/clients-list.tpl.php';
                    break;
                case 'single':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/clients-single.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/clients-create.tpl.php';
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showBackendAnalysis()
        {
            switch($this->app->request->request['l4']) {
                case 'dashboard':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/analysis-dashboard.tpl.php';
                    break;
            }
        }
    }
}