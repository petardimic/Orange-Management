<?php
namespace Modules\Tasks\Models;

/**
 * Task status enum
 *
 * PHP Version 5.4
 *
 * @category   Tasks
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class TaskStatus extends \phpOMS\Datatypes\Enum
{
    const UNSEEN    = 0;
    const SEEN      = 1;
    const WORKING   = 2;
    const SUSPENDED = 3;
    const CANCELED  = 4;
    const DONE      = 5;

}