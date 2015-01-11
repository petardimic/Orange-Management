<?php
namespace Modules\RiskManagement {
    /**
     * RiskManagement class
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
        public function __construct($app, $themePath)
        {
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
            switch($this->app->request->request['l4']) {
                case 'cockpit':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/cockpit.tpl.php';
                    break;
                case 'risk':
                    $this->show_backend_risk();
                    break;
                case 'cause':
                    $this->show_backend_cause();
                    break;
                case 'solution':
                    $this->show_backend_solution();
                    break;
                case 'settings':
                    $this->show_backend_settings();
                    break;
                case 'unit':
                    $this->show_backend_unit();
                    break;
                case 'department':
                    $this->show_backend_department();
                    break;
                case 'category':
                    $this->show_backend_category();
                    break;
                case 'project':
                    $this->show_backend_project();
                    break;
                case 'process':
                    $this->show_backend_process();
                    break;
            }
        }

        public function show_backend_risk()
        {
            switch($this->app->request->request['l5']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/risk-list.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/risk-create.tpl.php';
                    break;
                case 'single':
                    $this->show_backend_risk_single();
                    break;
            }
        }

        public function show_backend_risk_single()
        {
            switch($this->app->request->request['l6']) {
                case 'dashboard':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/risk-single-dashboard.tpl.php';
                    break;
            }
        }

        public function show_backend_cause()
        {
            switch($this->app->request->request['l5']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/cause-list.tpl.php';
                    break;
            }
        }

        public function show_backend_solution()
        {
            switch($this->app->request->request['l5']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/solution-list.tpl.php';
                    break;
            }
        }

        public function show_backend_unit()
        {
            switch($this->app->request->request['l5']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/unit-list.tpl.php';
                    break;
            }
        }

        public function show_backend_category()
        {
            switch($this->app->request->request['l5']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/category-list.tpl.php';
                    break;
            }
        }

        public function show_backend_department()
        {
            switch($this->app->request->request['l5']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/department-list.tpl.php';
                    break;
            }
        }

        public function show_backend_project()
        {
            switch($this->app->request->request['l5']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/project-list.tpl.php';
                    break;
            }
        }

        public function show_backend_process()
        {
            switch($this->app->request->request['l5']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/process-list.tpl.php';
                    break;
            }
        }

        public function show_backend_settings()
        {
            switch($this->app->request->request['l5']) {
                case 'dashboard':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/Theme/' . $this->themePath . '/backend/settings-list.tpl.php';
                    break;
            }
        }
    }
}