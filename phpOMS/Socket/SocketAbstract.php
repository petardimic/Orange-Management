<?php
namespace phpOMS\Socket;

/**
 * Socket class
 *
 * PHP Version 5.4
 *
 * @category   Socket
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class SocketAbstract implements \phpOMS\Socket\SocketInterface
{

// region Class Fields
    /**
     * Socket ip
     *
     * @var string
     * @since 1.0.0
     */
    protected $ip = null;

    /**
     * Socket port
     *
     * @var int
     * @since 1.0.0
     */
    protected $port = null;

    /**
     * Socket running?
     *
     * @var bool
     * @since 1.0.0
     */
    protected $run = true;

    /**
     * Socket
     *
     * @var resource
     * @since 1.0.0
     */
    protected $sock = null;

// endregion

    /**
     * {@inheritdoc}
     */
    public function create($ip, $port)
    {
        $this->ip   = $ip;
        $this->port = $port;

        $this->sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    }

    /**
     * Destructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        if($this->sock !== null) {
            socket_close($this->sock);
            $this->sock = null;
        }
    }
}