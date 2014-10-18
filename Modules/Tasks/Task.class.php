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
    class Task implements \Framework\DataStorage\Database\Objects\ObjectInterface {
        public $id = null;
        public $title = null;
        public $creator = null;
        public $created = null;
        public $desc = null;
        public $status = null;

        private $TaskElements = [];

        public function __construct($id) {
            $this->id = $id;
        }

        public function add_element($element) {
            $this->TaskElements[] = $element;
        }

        public function remove_element($id) {
            if (array_key_exists($id, $this->TaskElements)) {
                unset($this->TaskElements[$id]);
            }
        }
    }
}