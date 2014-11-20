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
    abstract class ModuleAbstract implements \Framework\Module\ModuleInterface {
        /**
         * Application instance
         *
         * @var \Framework\ApplicationInterface
         * @since 1.0.0
         */
        protected $app = null;

        /**
         * Receiving modules from?
         *
         * @var string[]
         * @since 1.0.0
         */
        public $receiving = [];

        /**
         * Theme path
         *
         * @var string
         * @since 1.0.0
         */
        protected $theme_path = null;

        /**
         * Object constructor
         *
         * @param \Framework\ApplicationInterface $app Application instance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public function __construct($app, $theme) {
            $this->app = $app;
            $this->theme_path = $theme;
        }

        public function callPull() {
            foreach ($this->receiving as $mid) {
                /** @noinspection PhpUndefinedMethodInspection */
                \Framework\Module\ModuleFactory::$loaded[$mid]->callPush();
            }
        }
    }
}