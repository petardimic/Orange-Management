<?php
namespace phpOMS\Socket\Server;

/**
 * Server class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Socket\Server
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Server extends \phpOMS\Socket\SocketAbstract
{
    /**
     * Socket connection limit
     *
     * @var int
     * @since 1.0.0
     */
    private $limit = 10;

    /**
     * Client connections
     *
     * @var array
     * @since 1.0.0
     */
    private $conn = [];

    /**
     * Clients
     *
     * @var \phpOMS\Socket\Server\ClientManager
     * @since 1.0.0
     */
    private $clientManager = null;

    /**
     * Commands
     *
     * @var \phpOMS\Socket\CommandManager
     * @since 1.0.0
     */
    private $cmdManager = null;

    /**
     * Packet manager
     *
     * @var \phpOMS\Socket\Packets\PacketManager
     * @since 1.0.0
     */
    private $packetManager = null;

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        $this->cmdManager    = new \phpOMS\Socket\CommandManager();
        $this->packetManager = new \phpOMS\Socket\Packets\PacketManager($this->cmdManager, $this->clientManager);

        /** @noinspection PhpUnusedParameterInspection */
        $this->cmdManager->attach('disconnect', function ($conn, $para) {
            $this->disconnect($conn);
        }, $this);

        /** @noinspection PhpUnusedParameterInspection */
        $this->cmdManager->attach('help', function ($conn, $para) {
            $this->help($conn, $para);
        }, $this);

        /** @noinspection PhpUnusedParameterInspection */
        $this->cmdManager->attach('version', function ($conn, $para) {
            $this->version($conn);
        }, $this);

        $this->cmdManager->attach('help', function ($conn, $para) {
            $this->kick($conn, $para);
        }, $this);

        /** @noinspection PhpUnusedParameterInspection */
        $this->cmdManager->attach('restart', function ($conn, $para) {
            $this->restart($conn, $para);
        }, $this);
    }

    /**
     * {@inheritdoc}
     */
    public function create($ip, $port)
    {
        parent::create($ip, $port);
        socket_bind($this->sock, $this->ip, $this->port);
    }

    /**
     * Set connection limit
     *
     * @param int $limit Connection limit
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        socket_listen($this->sock);
        socket_set_nonblock($this->sock);
        $this->conn[] = $this->sock;

        while($this->run) {
            $read = $this->conn;

            if(socket_select($read, $write = null, $except = null, 0) < 1) {
                // error
                // socket_last_error();
                // socket_strerror(socket_last_error());
                // socket_clear_error();
            }

            if(in_array($this->sock, $read)) {
                $this->conn[] = $newc = socket_accept($this->sock);

                $welcome = "Welcome to the server.\n";
                socket_write($newc, $welcome, strlen($welcome));
                socket_getpeername($newc, $ip);

                unset($read[0]);
            }

            foreach($read as $key => $client) {
                $data = socket_read($client, 1024);

                if($this->clientReadError($key)) {
                    continue;
                }

                $this->packetManager->handle(trim($data), $key);
            }
        }

        $this->close();
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        parent::close();
    }

    /**
     * {@inheritdoc}
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Disconnect client
     *
     * @param mixed $key Client key
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function disconnect($key)
    {
        socket_write($this->conn[$key], 'disconnect', strlen('disconnect'));
        unset($this->conn[$key]);
        $this->conn = array_values($this->conn);
    }

    /**
     * Help for client
     *
     * @param mixed $key  Client key
     * @param mixed $para Help parameters
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function help($key, $para)
    {
    }

    /**
     * Server version for client
     *
     * @param mixed $key Client key
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function version($key)
    {
    }

    /**
     * Kick client by Id
     *
     * @param mixed $key  Client key
     * @param mixed $para Kick parameters
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function kick($key, $para)
    {
    }

    /**
     * Restart server
     *
     * @param mixed $key  Client key
     * @param mixed $para Restart parameters
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function restart($key, $para)
    {
    }

    /**
     * Handle client read error
     *
     * @param mixed $key Client key
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function clientReadError($key)
    {
        if(socket_last_error() === 10054) {
            socket_clear_error();
            unset($this->conn[$key]);
            $this->conn = array_values($this->conn);

            return true;
        }

        return false;
    }
}