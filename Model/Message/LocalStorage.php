<?php
namespace Model\Message;

/**
 * LocalStorage class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Model\Message
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class LocalStorage implements \phpOMS\Contract\RenderableInterface, \phpOMS\Contract\ArrayableInterface
{

    /**
     * Message type
     *
     * @var string
     * @since 1.0.0
     */
    const TYPE = 'localstorage';

// region Class Fields
    /**
     * Local storage key|value array
     *
     * @var string
     * @since 1.0.0
     */
    private $values = [];

// endregion

    /**
     * Local storage value to set
     *
     * @param mixed   $key       Value key
     * @param mixed   $value     Value to store
     * @param boolean $overwrite Overwrite if exists
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setValue($key, $value, $overwrite = true)
    {
        if($overwrite || !isseT($this->values[$key])) {
            $this->values[$key] = $value;
        }
    }

    /**
     * Render message
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function render()
    {
        return $this->__toString();
    }

    /**
     * Stringify
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __toString()
    {
        return json_encode($this->toArray());
    }

    /**
     * Generate message array
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function toArray()
    {
        return ['type' => self::TYPE, 'values' => $this->values];
    }
}