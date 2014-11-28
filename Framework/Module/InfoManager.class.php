<?php
namespace Framework\Module {
    /**
     * InfoManager class
     *
     * Handling the info files for modules
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
    class InfoManager {
        /**
         * File pointer
         *
         * @var mixed
         * @since 1.0.0
         */
        private $fp = null;

        /**
         * Object constructor
         *
         * @param string $module Module name
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public function __construct($module) {
            if(file_exists(__DIR__ . '/../../Modules/' . $module . '/info.json')) {
                $this->fp = fopen(__DIR__ . '/../../Modules/' . $module . '/info.json', 'r');
            }
        }

        public function update() {
            // TODO: update file (convert to json)
        }

        /**
         * Object destructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public function __destruct() {
            $this->fp->close();
        }
    }
}