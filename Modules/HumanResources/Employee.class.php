<?php
namespace Modules\HumanResources {
    /**
     * Employee class
     *
     * PHP Version 5.4
     *
     * @category   HumanResources
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Employee implements \Framework\Object\ObjectInterface, \Framework\Pattern\Multition
    {
        /**
         * Employee ID
         *
         * @var int
         * @since 1.0.0
         */
        private $id = null;

        /**
         * User
         *
         * @var \Framework\Object\User\User
         * @since 1.0.0
         */
        private $user = null;

        private static $instances = [];

        public function __construct($id)
        {
        }

        public function getInstance($id)
        {
            if(!isset(self::$instances[$id])) {
                self::$instances[$id] = new self($id);
            }

            return self::$instances[$id];
        }

        public function setUser($id)
        {
            $this->user = new \Framework\Object\User\User($id);
        }
    }
}