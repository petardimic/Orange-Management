<?php
namespace phpOMS\Models\User;

/**
 * User type enum
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
abstract class UserType extends \phpOMS\Datatypes\Enum
{
    const PERSON       = 0; /* Account belongs to real person */
    const ORGANIZATION = 1; /* Account belongs to a organization */
    const COMPANY      = 2; /* Account belongs to a company */
    const GROUP        = 3; /* Account belongs to a group */
    const CHILD        = 4; /* Child account of existing account (e.g. employees of company) */

}