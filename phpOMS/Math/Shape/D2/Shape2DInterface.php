<?php
namespace phpOMS\Math\Shape\D2;

/**
 * 2D Shape interface
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Math
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface Shape2DInterface extends \phpOMS\Math\Shape\ShapeInterface
{
    /**
     * Get the polygon perimeter
     *
     * @return float
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPerimeter();

    /**
     * Set the polygon perimeter
     *
     * @param float $perimeter Polygon perimeter
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPerimeter($perimeter);

    /**
     * Get the polygon perimeter formula
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPerimeterFormula();

    /**
     * Get the polygon surface
     *
     * @return float
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getSurface();

    /**
     * Set the polygon surface
     *
     * @param float $surface Polygon surface
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setSurface($surface);

    /**
     * Get the polygon surface formula
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getSurfaceFormula();

    /**
     * Get the interior angle sum
     *
     * @return int|float
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getInteriorAngleSum();

    /**
     * Get the interior angle sum formula
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getInteriorAngleSumFormula();

    /**
     * Get the exterior angle sum
     *
     * @return int|float
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getExteriorAngleSum();

    /**
     * Get the exterior angle sum formula
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getExteriorAngleSumFormula();

    /**
     * Get the barycenter of the polygon
     *
     * @return float[]
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getBarycenter();

    /**
     * Reset all values
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function reset();
}