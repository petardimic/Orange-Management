<?php
namespace Modules\Sales\Models;

/**
 * Invoice types enum
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Sales
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class InvoiceStatus extends \Framework\Datatypes\Enum
{
    const BLOCKED        = 0; /* Invoice needs approval */
    const DRAFT          = 1; /* Invoice is still in draft */
    const READY          = 2; /* Invoice is ready for accounting transfer */
    const UNPAID         = 3; /* Invoice is not paid */
    const PAID_PARTIALLY = 4; /* Invoice is partially paid */
    const PAID           = 5; /* Invoice is paid */
    const OFFSETTING     = 6; /* This invoice may receive a credit */ /* TODO: careful this could be used in a bad way (only allow accounting to unset this) */
    const OPEN     = 7; /* offer & confirmation */
    const CHANGED  = 8; /* offer & confirmation */
    const CLOSED   = 9; /* offer & confirmation */
    const ACCEPTED = 10; /* offer & confirmation */

}