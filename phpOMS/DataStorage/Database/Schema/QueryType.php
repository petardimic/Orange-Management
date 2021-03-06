<?php
namespace phpOMS\DataStorage\Database\Schema;

/**
 * Database type enum
 *
 * Database types that are supported by the application
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\DataStorage\Database
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class QueryType extends \phpOMS\Datatypes\Enum
{

    const CREATE = 0;

    const DROP   = 1;

    const ALTER  = 2;

}
