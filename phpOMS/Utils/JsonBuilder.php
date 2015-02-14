<?php
namespace phpOMS\Utils;

/**
 * Json builder class
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
class JsonBuilder
{
    /**
     * Json data
     *
     * @var array
     * @since 1.0.0
     */
    private $json = [];

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function __construct()
    {
    }

    /**
     * Get json data
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function getJson()
    {
        return $this->json;
    }

    /**
     * Add data
     *
     * @param string $path      Path used for storage
     * @param array  $value     Data to add
     * @param bool   $overwrite Should overwrite existing data
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function add($path, $value, $overwrite = true)
    {
        $this->json = \phpOMS\Utils\ArrayUtils::setArray($path, $this->json, $value, '/');
    }

    /**
     * Remove data
     *
     * @param string $path  Path to the element to delete
     * @param string $delim Delim used inside path
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function remove($path, $delim)
    {
        $this->json = \phpOMS\Utils\ArrayUtils::unsetArray($path, $this->json, $delim);
    }

    /**
     * Get json string
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function __toString()
    {
        return json_encode($this->json);
    }
}