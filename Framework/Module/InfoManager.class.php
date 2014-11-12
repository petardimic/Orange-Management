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
        private $fp = null;

        public $name = '';
        public $name_internal = '';
        public $version = '1.0.0';

        public function __construct($module) {
            $this->fp = fopen(__DIR__ . '/../../Modules/' . $module . '/info.json');
        }

        public function update() {
            // TODO: update file (convert to json)
        }

        public function __destruct() {
            $this->fp->close();
        }
    }
}