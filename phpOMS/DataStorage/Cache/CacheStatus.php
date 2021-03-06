<?php
namespace phpOMS\DataStorage\Cache;

/**
 * Cache status enum
 *
 * Possible caching status
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\DataStorage\Cache
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class CacheStatus extends \phpOMS\Datatypes\Enum
{

    const INACTIVE   = 0; /* Caching is disabled */
    const ERROR      = 1; /* Caching failed */
    const MEMCACHE   = 2; /* Caching OK */
    const FILECACHE  = 3; /* Caching OK */
    const REDISCACHE = 4; /* Caching OK */
    const WINCACHE   = 5; /* Caching OK */

}