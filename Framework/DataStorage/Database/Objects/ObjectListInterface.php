<?php
namespace Framework\DataStorage\Database\Objects;

/**
 * Object list interface
 *
 * Interface for a list of database object. Usually usefull for search results and lists.
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
interface ObjectListInterface extends \Serializable, \Countable
{
    public function getObject();

    public function instantiate();
}