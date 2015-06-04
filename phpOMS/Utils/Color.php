<?php
namespace phpOMS\Utils;

/**
 * Color class for color operations
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Asset
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Color
{
    /**
     * Creates a 3 point gradient based on a input value
     *
     * @param int   $value Value to represent by color
     * @param int[] $start Gradient start
     * @param int[] $stop  Gradient stop
     * @param int[] $end   Gradient end
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getRGBGradient($value, $start, $stop, $end)
    {
        if($value <= $stop[0]) {
            if($value < $start[0]) {
                $value = $start[0];
            }
            $diff[0] = $stop[0] - $start[0];
            $diff[1] = $stop[1] - $start[1];
            $diff[2] = $stop[2] - $start[2];
            $diff[3] = $stop[3] - $start[3];

            $gradient['r'] = $start[1] + ($value - $start[0]) / ($diff[0]) * $diff[1];
            $gradient['g'] = $start[2] + ($value - $start[0]) / ($diff[0]) * $diff[2];
            $gradient['b'] = $start[3] + ($value - $start[0]) / ($diff[0]) * $diff[3]; // 206 -97 -20
        } else {
            if($value > $end[0]) {
                $value = $end[0];
            }
            $diff[0] = $end[0] - $stop[0];
            $diff[1] = $end[1] - $stop[1];
            $diff[2] = $end[2] - $stop[2];
            $diff[3] = $end[3] - $stop[3];

            $gradient['r'] = $stop[1] + ($value - $stop[0]) / ($diff[0]) * $diff[1];
            $gradient['g'] = $stop[2] + ($value - $stop[0]) / ($diff[0]) * $diff[2];
            $gradient['b'] = $stop[3] + ($value - $stop[0]) / ($diff[0]) * $diff[3];
        }

        foreach($gradient as &$color) {
            if($color > 255) {
                $color = 255;
            } elseif($color < 0) {
                $color = 0;
            } else {
                $color = (int) $color;
            }
        }

        return $gradient;
    }
}