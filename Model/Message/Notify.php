<?php
namespace Model\Message;

/**
 * Notify class
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
class Notify implements \phpOMS\Contract\RenderableInterface, \phpOMS\Contract\ArrayableInterface
{

    /**
     * Message type
     *
     * @var string
     * @since 1.0.0
     */
    const TYPE = 'redirect';

// region Class Fields
    /**
     * Notification title
     *
     * @var string
     * @since 1.0.0
     */
    private $title = '';

    /**
     * Message
     *
     * @var string
     * @since 1.0.0
     */
    private $message = '';

    /**
     * Delay in ms
     *
     * @var int
     * @since 1.0.0
     */
    private $delay = 0;

    /**
     * Level or type
     *
     * @var \Model\Message\NotifyType
     * @since 1.0.0
     */
    private $level = \Model\Message\NotifyType::INFO;

// endregion

    /**
     * Set delay
     *
     * @param int $delay Delay in ms
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;
    }

    /**
     * Set title
     *
     * @param string $title Title
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set message
     *
     * @param string $message Message
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Set level/type
     *
     * @param \Model\Message\NotifyType $level Notification type/level
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLevel($level)
    {
        $this->level = $level;
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
        return ['type'  => self::TYPE,
                'time'  => $this->delay,
                'msg'   => $this->message,
                'title' => $this->title,
                'level' => $this->level];
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
}