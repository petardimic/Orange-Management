<?php
namespace Modules\Warehousing\Models;
    /**
     * Packaging status enum
     *
     * PHP Version 5.4
     *
     * @category   Warehousing
     * @package    Modules
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class PackagingStatus extends \Framework\Datatypes\Enum
    {
        const PENDING   = 0;
        const PACKING   = 1;
        const PACKED    = 2;
        const SUSPENDED = 3;
        const CANCELED  = 4;

    }