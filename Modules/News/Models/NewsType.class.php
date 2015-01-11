<?php
namespace Modules\News\Models {
    /**
     * News type enum
     *
     * PHP Version 5.4
     *
     * @category   Module
     * @package    Modules\News
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class NewsType extends \Framework\Datatypes\Enum
    {
        const NEWS     = 0;
        const LINK     = 1;
        const HEADLINE = 2;
    }
}