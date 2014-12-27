<?php
namespace Modules\Calendar\OccurrenceType {
    /**
     * Occurrence type enum
     *
     * PHP Version 5.4
     *
     * @category   OccurrenceType
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class OccurrenceType extends \Framework\Datatypes\Enum
    {
        const SINGLE = 0;
        const DAILY = 1;
        const WEEKLY = 2;
        const MONTHLY = 3;
        const QUARTERLY = 4;
        const YEARLY = 5;
    }
}