<?php
namespace Framework\Object;

/**
 * Object interface
 *
 * Every object that gets created by a limited amount of database rows/columns is a database object.
 * Modifications on this object can be transfered to the database and cache
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
interface MapperInterface extends \Serializable
{
    /**
     * Init object by ID
     *
     * This usually happens from DB or cache
     *
     * @param int $id Object ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function init($id);

    /**
     * Removing the current object from cache and database
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function delete();

    /**
     * Creating the current object in cache and database
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function create();

    /**
     * Updating the current object in cache and database
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function update();
}