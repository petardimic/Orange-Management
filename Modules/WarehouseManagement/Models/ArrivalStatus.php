<?php
namespace Modules\Warehousing\Models;

/**
 * Arrival status enum
 *
 * PHP Version 5.4
 *
 * @category   Warehousing
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class ArrivalStatus extends \phpOMS\Datatypes\Enum
{
    const NONE     = 0;
    const PENDING  = 1;
    const CHECKING = 2;
    const SORTING  = 3;
    const FINISHED = 4;

}