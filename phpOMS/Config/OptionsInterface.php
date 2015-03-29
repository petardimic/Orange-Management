<?php
namespace phpOMS\Config;

/**
 * Options class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Config
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface OptionsInterface
{
    /**
     * Is this key set
     *
     * @param mixed $key Key to check for existence
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function exists($key);

    /**
     * Updating or adding settings
     *
     * @param mixed $key      Unique option key
     * @param mixed $value    Option value
     * @param bool  $overwrite Overwrite existing value
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setOption($key, $value, $overwrite = true);

    /**
     * Get option by key
     *
     * @param mixed $key Unique option key
     *
     * @return mixed Option value
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getOption($key);
}
