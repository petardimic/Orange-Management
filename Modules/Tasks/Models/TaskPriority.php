<?php
namespace Modules\Tasks\Models {
    /**
     * Task priority enum
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
    abstract class TaskPriority extends \Framework\Datatypes\Enum
    {
        const VLOW   = 1;
        const LOW    = 2;
        const MEDIUM = 3;
        const HIGH   = 4;
        const VHIGH  = 5;
    }
}