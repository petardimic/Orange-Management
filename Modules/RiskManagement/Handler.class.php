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
    class Handler extends \Framework\Module\ModuleAbstract {
        /**
         * Providing
         *
         * @var int[]
         * @since 1.0.0
         */
        public $providing = [
            1004100000,
            1004400000
        ];

        /**
         * Constructor
         *
         * @param string                 $theme_path
         * @param \Framework\WebApplication $app Application reference
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($theme_path, $app) {
            parent::initialize($theme_path, $app);
        }

        /**
         * Shows module content
         *
         * @para   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_content() {
            switch ($this->app->request->getType()) {
                case \Framework\Request\WebRequestPage::BACKEND:
                    $this->show_content_backend();
                    break;
            }
        }

        public function show_content_backend() {
            switch ($this->app->request->uri['l4']) {
                case 'cockpit':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/cockpit.tpl.php';
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
            }
        }

        public function show_backend_risk() {
            switch ($this->app->request->uri['l5']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/risk-list.tpl.php';
                    break;
                case 'create':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/risk-create.tpl.php';
                    break;
                case 'single':
                    $this->show_backend_risk_single();
                    break;
            }
        }

        public function show_backend_risk_single() {
            switch ($this->app->request->uri['l6']) {
                case 'dashboard':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/risk-single-dashboard.tpl.php';
                    break;
            }
        }

        public function show_backend_cause() {
            switch ($this->app->request->uri['l5']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/cause-list.tpl.php';
                    break;
            }
        }

        public function show_backend_solution() {
            switch ($this->app->request->uri['l5']) {
                case 'list':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/solution-list.tpl.php';
                    break;
            }
        }

        public function show_backend_settings() {
            switch ($this->app->request->uri['l5']) {
                case 'dashboard':
                    /** @noinspection PhpIncludeInspection */
                    include __DIR__ . '/themes' . $this->theme_path . '/backend/settings-list.tpl.php';
                    break;
            }
        }
    }
}