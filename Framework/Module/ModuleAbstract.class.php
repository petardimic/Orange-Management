<?php
namespace Framework\Module {
    /**
     * Module abstraction class
     *
     * PHP Version 5.4
     *
     * @category   Module
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class ModuleAbstract {
        /**
         * Dependencies
         *
         * @var int[]
         * @since 1.0.0
         */
        public $dependencies = null;

        /**
         * Receiving
         *
         * @var int[]
         * @since 1.0.0
         */
        public $receiving = null;

        /**
         * Providing
         *
         * @var int[]
         * @since 1.0.0
         */
        public $providing = null;

        /**
         * Theme path
         *
         * @var string
         * @since 1.0.0
         */
        public $theme_path = '';

        /**
         * Application instance
         *
         * @var \Framework\Application
         * @since 1.0.0
         */
        protected $app = null;

        /**
         * Constructor
         *
         * @param string $theme_path
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        protected function initialize($theme_path, $app) {
            $this->app        = $app;
            $this->theme_path = $theme_path;
        }

        /**
         * Shows module content
         *
         * @para   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show($data = null) {
        }

        /**
         * Shows module content provided by other modules
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        protected function show_push() {
            if (isset(self::$receiving)) {
                foreach (self::$receiving as $mid) {
                    /** @noinspection PhpUndefinedMethodInspection */
                    \Framework\Module\ModuleFactory::$initialized[$mid]->show_content_push();
                }
            }
        }

        /**
         * Shows module content provided by other modules
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_content_push() {
        }
    }
}