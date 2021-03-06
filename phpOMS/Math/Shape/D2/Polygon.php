<?php
namespace phpOMS\Math\Shape\D2;

/**
 * Polygon class
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
class Polygon implements \phpOMS\Math\Shape\D2\Shape2DInterface
{

// region Class Fields
    /**
     * Coordinates
     *
     * These coordinates define the polygon
     *
     * @var array[]
     * @since 1.0.0
     */
    private $coord = null;

    /**
     * Polygon perimeter
     *
     * @var float
     * @since 1.0.0
     */
    private $perimeter = null;

    /**
     * Polygon surface
     *
     * @var float
     * @since 1.0.0
     */
    private $surface = null;

    /**
     * Interior angle sum of the polygon
     *
     * @var float
     * @since 1.0.0
     */
    private $interiorAngleSum = null;

    /**
     * Exterior angle sum of the polygon
     *
     * @var float
     * @since 1.0.0
     */
    private $exteriorAngleSum = null;

    /**
     * Polygon barycenter
     *
     * @var float[]
     * @since 1.0.0
     */
    private $barycenter = null;

    /**
     * Polygon edge length
     *
     * @var float
     * @since 1.0.0
     */
    private $edgeLength = [];

    /**
     * Polygon inner length
     *
     * @var float
     * @since 1.0.0
     */
    private $innerLength = null;

    /**
     * Polygon inner edge angular
     *
     * @var float
     * @since 1.0.0
     */
    private $innerEdgeAngular = null;

// endregion

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
    }

    /**
     * Set polygon coordinates
     *
     * @param array[] $coord Coordinates
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCoordinates($coord)
    {
        $this->coord = $coord;
    }

    /**
     * Set polygon coordinate
     *
     * @param int       $i Index
     * @param int|float $x X coordinate
     * @param int|float $y Y coordinate
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCoordinate($i, $x, $y)
    {
        $this->coord[$i] = ['x' => $x, 'y' => $y];
    }

    /**
     * {@inheritdoc}
     */
    public function getInteriorAngleSum()
    {
        $this->interiorAngleSum = (count($this->coord) - 2) * 180;

        return $this->interiorAngleSum;
    }

    /**
     * {@inheritdoc}
     */
    public function getExteriorAngleSum()
    {
        return 360;
    }

    /**
     * {@inheritdoc}
     */
    public function getInteriorAngleSumFormula()
    {
        return "";
    }

    /**
     * {@inheritdoc}
     */
    public function getExteriorAngleSumFormula()
    {
        return "";
    }

    /**
     * {@inheritdoc}
     */
    public function getSurface()
    {
        $this->surface = 0;
        $count         = count($this->coord);

        for($i = 0; $i < $count - 2; $i++) {
            $this->surface += $this->coord[$i]['x'] * $this->coord[$i + 1]['y'] - $this->coord[$i + 1]['x'] * $this->coord[$i]['y'];
        }

        $this->surface /= 2;
        $this->surface = abs($this->surface);

        return $this->surface;
    }

    /**
     * {@inheritdoc}
     */
    public function setSurface($surface)
    {
        $this->reset();

        $this->surface = $surface;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->coord            = null;
        $this->barycenter       = null;
        $this->perimeter        = null;
        $this->surface          = null;
        $this->interiorAngleSum = null;
        $this->edgeLength       = null;
        $this->innerLength      = null;
        $this->innerEdgeAngular = null;
    }

    /**
     * {@inheritdoc}
     */
    public function getSurfaceFormula()
    {
        return "";
    }

    /**
     * {@inheritdoc}
     */
    public function getPerimeter()
    {
        $count           = count($this->coord);
        $this->perimeter = sqrt(($this->coord[0]['x'] - $this->coord[$count - 1]['x']) ** 2 + ($this->coord[0]['y'] - $this->coord[$count - 1]['y']) ** 2);

        for($i = 0; $i < $count - 2; $i++) {
            $this->perimeter += sqrt(($this->coord[$i + 1]['x'] - $this->coord[$i]['x']) ** 2 + ($this->coord[$i + 1]['y'] - $this->coord[$i]['y']) ** 2);
        }

        return $this->perimeter;
    }

    /**
     * {@inheritdoc}
     */
    public function setPerimeter($perimeter)
    {
        $this->reset();

        $this->perimeter = $perimeter;
    }

    /**
     * {@inheritdoc}
     */
    public function getPerimeterFormula()
    {
        return "";
    }

    /**
     * {@inheritdoc}
     */
    public function getBarycenter()
    {
        $this->barycenter['x'] = 0;
        $this->barycenter['y'] = 0;

        $count = count($this->coord);

        for($i = 0; $i < $count - 2; $i++) {
            $mult = ($this->coord[$i]['x'] * $this->coord[$i + 1]['y'] - $this->coord[$i + 1]['x'] * $this->coord[$i]['y']);
            $this->barycenter['x'] += ($this->coord[$i]['x'] + $this->coord[$i + 1]['x']) * $mult;
            $this->barycenter['y'] += ($this->coord[$i]['y'] + $this->coord[$i + 1]['y']) * $mult;
        }

        return $this->barycenter;
    }
}