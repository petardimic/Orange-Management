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
    class Warehouse implements \Framework\Object\ObjectInterface, \Framework\Pattern\Multition
    {
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
         * Location of the warehouse
         *
         * @var \Framework\Datatypes\Location
         * @since 1.0.0
         */
        private $location = null;

        /**
         * Warehouse
         *
         * @var \Modules\Warehousing\Warehouse[]
         * @since 1.0.0
         */
        private static $instances = [];

        /**
         * Constructor
         *
         * @param int $id Warehouse ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($id)
        {
            $this->id = $id;
        }

        /**
         * {@inheritdoc}
         */
        public function __clone()
        {
        }

        /**
         * Initializing object
         *
         * @param int $id Warehouse ID
         *
         * @return \Modules\Warehousing\Warehouse
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance($id)
        {
            if(!isset(self::$instances[$id])) {
                self::$instances[$id] = new self($id);
            }

            return self::$instances[$id];
        }

        /**
         * Get ID
         *
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getID()
        {
            return $this->id;
        }

        /**
         * Get name
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * Set name
         *
         * @param string $name Name of the article
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * Get name
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * Set name
         *
         * @param string $description Description of the warehouse
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setDescription($description)
        {
            $this->description = $description;
        }

        /**
         * Get location
         *
         * @return \Framework\Datatypes\Location
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getLocation()
        {
            return $this->location;
        }

        /**
         * Set location
         *
         * @param \Framework\Datatypes\Location $location Location of the warehouse
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setLocation($location)
        {
            $this->location = $location;
        }

        /**
         * {@inheritdoc}
         */
        public function delete()
        {
        }

        /**
         * {@inheritdoc}
         */
        public function create()
        {
        }

        /**
         * {@inheritdoc}
         */
        public function update()
        {
        }

        /**
         * {@inheritdoc}
         */
        public function serialize()
        {
        }

        /**
         * {@inheritdoc}
         */
        public function unserialize($data)
        {
        }
    }
}