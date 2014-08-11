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
    class BackendDashboard extends \Framework\Modules\ModuleAbstract {
        /**
         * Dependencies
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $dependencies = null;

        /**
         * Receiving
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $receiving = null;

        /**
         * Providing
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $providing = [
            1004100000 => true
        ];

        /**
         * Constructor
         *
         * @param string $theme_path
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($theme_path) {
            parent::initialize($theme_path);
        }

        /**
         * Install module
         *
         * @param \Framework\Core\Database $db   Database instance
         * @param array              $info Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install(&$db, $info) {
            parent::install_providing($db, __DIR__ . '/install/nav.install.json', 'Navigation');
        }

        /**
         * Install data from providing modules
         *
         * @param \Framework\Core\Database $db   Database instance
         * @param array              $data Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install_external(&$db, $data) {
        }

        /**
         * Shows module content
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_content() {
            if (isset(BackendDashboard::$receiving)) {
                foreach (BackendDashboard::$receiving as $mid) {
                    /** @noinspection PhpUndefinedMethodInspection */
                    \Framework\Modules\ModuleFactory::$initialized[$mid]->show_dashboard();
                }
            } else {
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/themes/' . $this->theme_path . '/default.php';
            }
        }
    }
}