<?php
namespace Framework\Message;

/**
 * Request status enum
 *
 * PHP Version 5.4
 *
 * @category   Request
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class RequestStatus extends \Framework\Datatypes\Enum
{
    const OK      = 0; /* Request is OK */
    const FAILURE = 1; /* Request failed (unknown reason) */

}