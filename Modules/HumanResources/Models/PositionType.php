<?php
namespace Modules\HumanResources\Models;

/**
 * Position type enum
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
abstract class PositionType extends \phpOMS\Datatypes\Enum
{
    const INTERN     = 0;
    const APPRENTICE = 1;
    const JUNIOR     = 2;
    const REGULAR    = 3;
    const SENIOR     = 4;
    const ASSISTANT  = 5;
    const TEAMLEADER = 6;
    const HEAD       = 7;

}