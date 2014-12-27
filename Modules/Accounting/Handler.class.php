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
         * @param \Framework\WebApplication $app       Application reference
         * @param string                    $themePath Theme path
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
                case 'creditor':
                    $this->showBackendCreditor();
                    break;
                case 'debitor':
                    $this->showBackendDebitor();
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showBackendCreditor() {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $creditorList = new \Modules\Accounting\CreditorList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/creditor-list.tpl.php';
                    break;
                case 'single':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/creditor-single.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/creditor-create.tpl.php';
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showBackendDebitor() {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $debitorList = new \Modules\Accounting\DebitorList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/debitor-list.tpl.php';
                    break;
                case 'single':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/debitor-single.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/debitor-create.tpl.php';
                    break;
            }
        }
    }
}