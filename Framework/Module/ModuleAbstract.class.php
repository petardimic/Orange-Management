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
         * Object constructor
         *
         * @param \Framework\ApplicationInterface $app Application instance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public function __construct($app) {
            $this->app = $app;
        }
    }
}