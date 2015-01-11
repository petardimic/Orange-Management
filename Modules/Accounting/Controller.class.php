<?php
namespace Modules\Accounting {
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
            'Media'
        ];

        /**
         * Constructor
         *
         * @param \Framework\WebApplication $app       Application reference
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
                case 'creditor':
                    $this->showBackendCreditor();
                    break;
                case 'debitor':
                    $this->showBackendDebitor();
                    break;
                case 'account':
                    $this->showBackendAccount();
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showBackendAccount()
        {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $accountList = new \Modules\Accounting\Models\AccountList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/account-list.tpl.php';
                    break;
                case 'postings':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/account-postings.tpl.php';
                    break;
                case 'balance':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/account-balance.tpl.php';
                    break;
                case 'single':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/account-single.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/account-create.tpl.php';
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showBackendCreditor()
        {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $creditorList = new \Modules\Accounting\Models\CreditorList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/creditor-list.tpl.php';
                    break;
                case 'single':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/creditor-single.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/creditor-create.tpl.php';
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showBackendDebitor()
        {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $debitorList = new \Modules\Accounting\Models\DebitorList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/debitor-list.tpl.php';
                    break;
                case 'single':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/debitor-single.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/backend/debitor-create.tpl.php';
                    break;
            }
        }
    }
}