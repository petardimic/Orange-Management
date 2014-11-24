<?php
namespace Modules\Support {
    /**
     * Issue class
     *
     * PHP Version 5.4
     *
     * @category   Support
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Message implements \Framework\DataStorage\Database\Objects\ObjectInterface \Framework\Pattern\Multition {
        /**
         * Name
         *
         * @var string
         * @since 1.0.0
         */
        private $name = '';

        /**
         * Description
         *
         * @var string
         * @since 1.0.0
         */
        private $description = '';

        /**
         * Created
         *
         * @var datetime
         * @since 1.0.0
         */
        private $created = null;

        /**
         * Creator
         *
         * @var int
         * @since 1.0.0
         */
        private $creator = null;

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

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function getCreated() {
            return $this->created;
        }

        public function setCreated($created) {
            $this->created = $created;
        }

        public function getCreator() {
            return $this->creator;
        }

        public function setCreator($creator) {
            $this->creator = $creator;
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