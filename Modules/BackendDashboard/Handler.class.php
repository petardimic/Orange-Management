<?php
namespace Modules\BackendDashboard {
    /**
     * Dashboard class
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
    class Handler extends \Framework\Module\ModuleAbstract {
        /**
         * Providing
         *
         * @var int[]
         * @since 1.0.0
         */
        public $providing = [
            1004100000
        ];

        /**
         * Constructor
         *
         * @param string $theme_path
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
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_content() {
            if (isset($this->receiving)) {
                foreach ($this->receiving as $mid) {
                    /** @noinspection PhpUndefinedMethodInspection */
                    \Framework\Module\ModuleFactory::$initialized[$mid]->show_dashboard();
                }
            } else {
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/themes/' . $this->theme_path . '/default.php';
            }
        }
    }
}