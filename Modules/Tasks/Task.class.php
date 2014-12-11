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
    class Task implements \Framework\Object\ObjectInterface {
        /**
         * ID
         *
         * @var int
         * @since 1.0.0
         */
        public $id = null;

        /**
         * Title
         *
         * @var string
         * @since 1.0.0
         */
        public $title = null;

        /**
         * ID
         *
         * @var int
         * @since 1.0.0
         * @
         */
        public $creator = null;
        public $created = null;
        public $description = null;
        public $status = null;
        public $priority = null;

        private $task_elements = [];

        public function __construct($id) {
            $this->id = $id;
        }

        public function addElement($element) {
            $this->task_elements[] = $element;
        }

        public function removeElement($id) {
            if(array_key_exists($id, $this->task_elements)) {
                unset($this->task_elements[$id]);
            }
        }

        /**
         * {@inheritdoc}
         */
        public function delete() {
        }

        /**
         * {@inheritdoc}
         */
        public function create() {
        }

        /**
         * {@inheritdoc}
         */
        public function update() {
        }

        /**
         * {@inheritdoc}
         */
        public function serialize() {
        }

        /**
         * {@inheritdoc}
         */
        public function unserialize($data) {
        }
    }
}