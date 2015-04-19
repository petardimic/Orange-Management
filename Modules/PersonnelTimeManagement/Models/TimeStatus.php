<?php
namespace Modules\PersonnelTimeManagement\Models;

/**
 * Work status enum
 *
 * PHP Version 5.4
 *
 * @category   Module
 * @package    Modules\HumanResources
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class TimeStatus extends \phpOMS\Datatypes\Enum
{

    const ACCEPTED = 0;

    const OPEN     = 1;

}