<?php

abstract class Polygon implements Shape2D
{
    private $coord            = null;
    private $perimeter        = null;
    private $surface          = null;
    private $interiorAngleSum = null;
    private $barycenter       = null;
    private $edgeLength       = null;
    private $innerLength      = null;
    private $innerEdgeAngular = null;

    public function __construct()
    {
    }

    public function setCoordinates($coord)
    {
        $this->coord = $coord;
    }

    public function setCoordinate($i, $x, $y)
    {
        $this->coord[$i] = ['x' => $x, 'y' => $y];
    }

    public function getInteriorAngleSum()
    {
        $this->interiorAngleSum = (count($this->coord) - 2) * 180;

        return $this->interiorAngleSum;
    }

    public function getExteriorAngleSum()
    {
        return 360;
    }

    public function getInteriorAngleSumFormula()
    {
        return "";
    }

    public function getExteriorAngleSumFormula()
    {
        return "";
    }

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

    public function getSurfaceFormula()
    {
        return "";
    }

    public function getPerimeter()
    {
        $count           = count($this->coord);
        $this->perimeter = sqrt(($this->coord[0]['x'] - $this->coord[$count - 1]['x']) ** 2 + ($this->coord[0]['y'] - $this->coord[$count - 1]['y']) ** 2);

        for($i = 0; $i < $count - 2; $i++) {
            $this->perimeter += sqrt(($this->coord[$i + 1]['x'] - $this->coord[$i]['x']) ** 2 + ($this->coord[$i + 1]['y'] - $this->coord[$i]['y']) ** 2);
        }

        return $this->perimeter;
    }

    public function getPerimeterFormula()
    {
        return "";
    }

    public function setPerimeter($perimeter)
    {
        $this->reset();

        $this->perimeter = $perimeter;
    }

    public function setSurface($surface)
    {
        $this->reset();

        $this->surface = $surface;
    }

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

    private function reset()
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
}