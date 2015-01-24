<?php
namespace Framework\Utils;

/**
 * Array utils
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Framework\Utils
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class ArrayUtils
{
    /**
     * Check if needle exists in multidimensional array
     *
     * @param string $path  Path to element
     * @param array  $data  Array
     * @param string $delim Delimeter for path
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function unset_array($path, $data, $delim)
    {
        $nodes  = explode($delim, $path);
        $prevEl = null;
        $el     = &$data;

        $node = null;

        foreach($nodes as &$node) {
            $prevEl = &$el;
            $el     = &$el[$node];
        }

        if($prevEl !== null) {
            unset($prevEl[$node]);
        }

        return $data;
    }

    /**
     * Check if needle exists in multidimensional array
     *
     * @param mixed $needle   Needle for search
     * @param array $haystack Haystack for search
     * @param mixed $id       ID for search
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function in_array_r($needle, $haystack, $id = null)
    {
        $found = false;

        if(isset($id) && isset($haystack[$id]) && $haystack[$id] === $needle) {
            return true;
        }

        foreach($haystack as $item) {
            if($item === $needle) {
                return true;
            } elseif(is_array($item)) {
                $found = self::in_array_r($needle, $item, $id);

                if($found) {
                    break;
                }
            }
        }

        return $found;
    }
}