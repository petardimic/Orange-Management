<?php
namespace Modules\HumanResources {
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
                case 'structure':
                    $this->showContentBackendStrcture();
                    break;
                case 'staff':
                    $this->showContentBackendStaff();
                    break;
                case 'planning':
                    $this->showContentBackendPlanning();
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showContentBackendStrcture() {
            switch($this->app->request->request['l4']) {
                case 'department':
                    $this->showContentBackendDepartment();
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showContentBackendDepartment() {
            switch($this->app->request->request['l5']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $departments = new \Modules\HumanResources\DepartmentList($this->app->db);
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/department-list.tpl.php';
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showContentBackendStaff() {
            switch($this->app->request->request['l4']) {
                case 'list':
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $staff = new \Modules\HumanResources\StaffList($this->app->db);

                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/staff-list.tpl.php';
                    break;
                case 'single':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/staff-single.tpl.php';
                    break;
            }
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function showContentBackendPlanning() {
            switch($this->app->request->request['l4']) {
                case 'dashboard':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes/' . $this->themePath . '/backend/planning-dashboard.tpl.php';
                    break;
            }
        }
    }
}