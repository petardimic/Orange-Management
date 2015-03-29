<?php
namespace phpOMS\Config;

/**
 * Options trait
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
trait OptionsTrait
{
    /**
     * Options
     *
     * @var array
     * @since 1.0.0
     */
    private $options = [];

    /**
     * {@inheritdoc}
     */
    public function exists($key) {
        return array_key_exists($key, $this->options);
    }

    /**
     * {@inheritdoc}
     */
    public function getOption($key)
    {
        return (isset($this->options[$key]) ? $this->options[$key] : null);
    }

    /**
     * {@inheritdoc}
     */
    public function setOption($key, $value, $overwrite = true)
    {
        if($overwrite || !array_key_exists($key, $this->options)) {
            $this->options[$key] = [$value, $storable];
        }
    }
}
