<?php
namespace Modules\Tasks {
    /**
     * Task class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class TaskElement implements \Framework\DataStorage\Database\Objects\ObjectInterface {
        public $id = null;
        public $title = null;
        public $creator = null;
        public $created = null;
        public $desc = null;
        public $task = null;
        public $due = null;

        public function __construct($id) {
            $this->id = $id;
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