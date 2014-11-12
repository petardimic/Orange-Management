<?php
namespace Framework\Datatypes {
    /**
     * PriorityQueue class
     *
     * PHP Version 5.4
     *
     * @category   Datatypes
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class PriorityQueue implements \Countable, \Serializable {
        private $count = 0;
        private $queue = [];

        public function insert() {

        }

        public function get() {

        }

        public function delete() {

        }

        public function remove() {

        }

        public function count() {
            return $this->count;
        }

        public function serialize() {

        }

        public function unserialize($data) {

        }
    }
}