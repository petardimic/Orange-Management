<?php
namespace Modules\Accounting {
    /**
     * Time range type enum
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Modules\Accounting
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class TimeRangeType extends \Framework\Datatypes\Enum
    {
        const ENTRY_DATE      = 0; /* Date of when the entry happened */
        const DUE_DATE        = 1; /* Date of when the entry is due (only for invoices) */
        const RECEIPT_DATE    = 2; /* Date of the receipt */
        const ASSOCIATED_DATE = 3; /* Date of the association (e.g. when did the articles arrive) */
    }
}