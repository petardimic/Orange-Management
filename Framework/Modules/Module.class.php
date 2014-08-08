<?php
namespace Framework\Modules {
    /**
     * Module class
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
    class Module {
        /**
         * Database
         *
         * @var \Framework\Core\Database\Database
         * @since 1.0.0
         */
        private $db = null;

        /**
         * Cache instance
         *
         * @var \Framework\Core\Cache
         * @since 1.0.0
         */
        public $cache = null;

        /**
         * Module id
         *
         * @var int
         * @since 1.0.0
         */
        public $id = null;

        /**
         * Module info
         * Json file info
         *
         * @var array
         * @since 1.0.0
         */
        public $info = null;

        /**
         * Instances
         *
         * @var \Framework\Core\Cache
         * @since 1.0.0
         */
        protected static $instance = null;

        /**
         * Constructor
         *
         * @param int                $id    Module ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($id) {
            $this->id    = $id;
            $this->db    = \Framework\Core\Database\Database::getInstance();
            $this->cache = \Framework\Core\Cache::getInstance();
        }

        /**
         * Returns instance
         *
         * @param int $id Module ID
         *
         * @return \Framework\Modules\Module
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($id) {
            if (self::$instance === null) {
                self::$instance = new self($id);
            }

            return self::$instance;
        }

        /**
         * Protect instance from getting copied from outside
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        protected function __clone() {
        }

        /**
         * Get all active modules
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function module_info_get() {
            if (!isset($this->info)) {
                $path = __DIR__ . '/../../Modules/' . $this->id . '/info.json';

                if (file_exists($path)) {
                    $this->info = json_decode(file_get_contents($path), true);
                }
            }

            return $this->info;
        }
    }
}