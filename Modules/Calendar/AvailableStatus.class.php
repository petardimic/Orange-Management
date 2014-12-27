<?php
namespace Modules\Calendar {
    /**
     * Available status enum
     *
     * PHP Version 5.4
     *
     * @category   Calendar
     * @package    Modules
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class AvailableStatus extends \Framework\Datatypes\Enum
    {
        const AVAILABLE = 0;
        const BUSY      = 1;
        const AWAY      = 2;
    }
}