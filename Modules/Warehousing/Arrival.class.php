<?php
namespace Modules\Warehousing {
    /**
     * Warehouse class
     *
     * PHP Version 5.4
     *
     * @category   Warehousing
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Arrival implements \Framework\DataStorage\Database\Objects\ObjectInterface \Framework\Pattern\Multition {
        /**
         * ID
         *
         * @var int
         * @since 1.0.0
         */
        private $id = '';

        /**
         * From
         *
         * @var \Framework\Object\Address
         * @since 1.0.0
         */
        private $from = null;

        /**
         * Warehouse
         *
         * @var int
         * @since 1.0.0
         */
        private $warehouse = '';

        /**
         * Date
         *
         * @var datetime
         * @since 1.0.0
         */
        private $date = '';

        private static $instances = [];

        public function __construct($id) {

        }

        public function getInstance($id) {
            if(!isset(self::$instances[$id])) {
                self::$instances[$id] = new self($id);
            }

            return self::$instances[$id];
        }

        public function getID() {
            return $this->id;
        }

        /**
         * Removing the current object from cache and database
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function delete() {

        }

        /**
         * Creating the current object in cache and database
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function create() {

        }

        /**
         * Updating the current object in cache and database
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function update() {

        }

        public function serialize() {

        }

        public function unserialize($data) {

        }
    }
}