<?php
namespace Framework\DataStorage\Database\Objects {
    /**
     * Object interface
     *
     * Every object that gets created by a limited amount of database rows/columns is a database object.
     * Modifications on this object can be transfered to the database.
     *
     * PHP Version 5.4
     *
     * @category   DataStorage
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    interface ObjectInterface extends \Serializable {
        public function delete();

        public function create();

        public function edit();
    }
}