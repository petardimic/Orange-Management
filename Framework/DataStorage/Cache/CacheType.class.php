<?php
namespace Framework\DataStorage\Cache {
    /**
     * Cache type enum
     *
     * Possible caching types
     *
     * PHP Version 5.4
     *
     * @category   DataStorage
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class CacheType extends \Framework\Datatypes\Enum {
        const _NUMERIC = 0; /* Data is numeric */
        const _STRING = 1; /* Data is string */
        const _ARRAY = 2; /* Data is array */
        const _OBJECT = 3; /* Data is object */
        const _HEX = 4; /* Data is object */
    }
}