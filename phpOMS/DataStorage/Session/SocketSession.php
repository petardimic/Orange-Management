<?php
namespace phpOMS\DataStorage\Session;

/**
 * Socket session class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\DataStorage\Session
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class SocketSession implements \phpOMS\DataStorage\Session\SessionInterface
{
    /**
     * Session ID
     *
     * @var string|int
     * @since 1.0.0
     */
    private $sid = null;

    /**
     * Constructor
     *
     * @param string|int $sid Session id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($sid)
    {
        $this->sid = $sid;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
    }
}
