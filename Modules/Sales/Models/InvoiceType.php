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
abstract class InvoiceType extends \phpOMS\Datatypes\Enum
{

    const OFFER         = 0;

    const CONTRACT_NOTE = 1;

    const DELIVERY_NOTE = 2;

    const BILL          = 3;

}