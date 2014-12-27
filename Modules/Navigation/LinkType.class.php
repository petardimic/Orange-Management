<?php
namespace Modules\Navigation {
    /**
     * Link type enum
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class LinkType extends \Framework\Datatypes\Enum
    {
        const CATEGORY = 0;
        const LINK     = 1;
    }
}