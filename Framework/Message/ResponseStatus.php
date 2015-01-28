<?php
namespace Framework\Message;

/**
 * Response status enum
 *
 * PHP Version 5.4
 *
 * @category   Response
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class ResponseStatus extends \Framework\Datatypes\Enum
{
    const OK               = 0; /* Response is OK */
    const FAILURE          = 1; /* Response failed (unknown reason) */
    const WRONG_PERMISSION = 2; /* Permission lacking */
    const WRONG_REQUEST    = 3; /* No response for this request */

}