<?php
namespace phpOMS\Utils;

/**
 * Array utils
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Utils
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
    public static function unsetArray($path, $data, $delim)
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
     * @param string $path  Path to element
     * @param array  $data  Array
     * @param mixed  $value Value to add
     * @param string $delim Delimeter for path
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function setArray($path, $data, $value, $delim)
    {
        $pathParts = explode($delim, $path);
        $current   = &$data;

        foreach($pathParts as $key) {
            $current = &$current[$key];
        }

        if(is_array($current) && !is_array($value)) {
            $current[] = $value;
        } elseif(is_array($current) && is_array($value)) {
            $current += $value;
        } elseif(is_scalar($current) && $current !== null) {
            $current = [$current, $value];
        } else {
            $current = $value;
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
    public static function inArrayRecursive($needle, $haystack, $id = null)
    {
        $found = false;

        if(isset($id) && isset($haystack[$id]) && $haystack[$id] === $needle) {
            return true;
        }

        foreach($haystack as $item) {
            if($item === $needle) {
                return true;
            } elseif(is_array($item)) {
                $found = self::inArrayRecursive($needle, $item, $id);

                if($found) {
                    break;
                }
            }
        }

        return $found;
    }

    public static function stringify($array) {
        $str = '[';

        foreach($array as $key => $value) {
            switch(gettype($value)) {
                case 'array':
                    $str .= $key . ' => ' . self::stringify($value) . PHP_EOL;
                    break;
                case 'integer':
                case 'double':
                case 'float':
                    $str .= $key . ' => ' . $value . PHP_EOL;
                    break;
                case 'string':
                    $str .= $key . ' => "' . $value . '"' . PHP_EOL;
                    break;
                case 'object':
                    $str .= $key . ' => ' . get_class($value['default']) . '()';
                    // TODO: implement object with parameters -> Reflection
                    break;
                case 'boolean':
                    $str .= $key . ' => ' . ($value['default'] ? 'true' : 'false');
                    break;
                case 'NULL':
                    $str .= $key . ' => null';
                    break;
                default:
                    throw new \Exception('Unknown default type');

            }
        }

        return $str . ']';
    }
}