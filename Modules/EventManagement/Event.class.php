<?php
namespace Modules\EventManagement {
    /**
     * Event class
     *
     * PHP Version 5.4
     *
     * @category   EventManager
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Event implements \Framework\DataStorage\Database\Objects\ObjectInterface \Framework\Pattern\Multition {
        /**
         * ID
         *
         * @var int
         * @since 1.0.0
         */
        private $id = null;

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
        private $description = null;

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

        /**
         * Calendar
         *
         * Start, end, sub-schedules, people, where
         *
         * @var \Modules\Calender\Calender
         * @since 1.0.0
         */
        private $calendar = null;

        /**
         * People/Users
         *
         * @var array
         * @since 1.0.0
         */
        private $people = [];

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
            return $name;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function getDescription() {
            return $this->description;
        }

        public function setDescription($desc) {
            $this->descritpion = $desc;
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

        public function getCalendar() {
            return $this->calender;
        }

        public function setCalender($calender) {
            $this->calender = $calender;
        }

        public function getPeople() {
            return $this->people;
        }

        public function setPeople($people) {
            $this->people = $people;
        }

        public function addPerson($person) {
            if(!isset($this->people[$person['id']])) {
                $this->people[$person['id']] = $person;
            }
        }

        public function removePerson($id) {
            if(isset($this->people[$id])) {
                unset($this->people[$id]);
            }
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