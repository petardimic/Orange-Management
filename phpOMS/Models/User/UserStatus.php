<?php
namespace phpOMS\Models\User;

/**
 * User status enum
 *
 * PHP Version 5.4
 *
 * @category   Models
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class UserStatus extends \phpOMS\Datatypes\Enum
{
    const ACTIVE    = 0; /* Account is active */
    const INACTIVE  = 1; /* Account is inactive */
    const BANNED    = 2; /* Account is banned */
    const TIMEOUTED = 3; /* Account is banned for a certain time */
    const VIRTUAL   = 4; /* Account can not log in */

}