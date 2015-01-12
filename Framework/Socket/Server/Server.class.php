<?php
namespace Framework\Socket\Server {
    /**
     * Server class
     *
     * Parsing/serializing arrays to and from php file
     *
     * PHP Version 5.4
     *
     * @category   System
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Server extends \Framework\Socket\SocketAbstract
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
         * @var array
         * @since 1.0.0
         */
        private $clients = [];

        public $commands = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct()
        {
            $this->commands = new \Framework\Socket\Commands();

            $this->commands->attach('disconnect', function ($conn, $para) {
                $this->disconnect($conn);
            }, $this);

            $this->commands->attach('help', function ($conn, $para) {
                $this->help($conn);
            }, $this);

            $this->commands->attach('version', function ($conn, $para) {
                $this->version($conn);
            }, $this);

            $this->commands->attach('help', function ($conn, $para) {
                $this->kick($conn, $para);
            }, $this);

            $this->commands->attach('restart', function ($conn, $para) {
                $this->restart($conn);
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

                    /* Client no data */
                    if($data === false) {
                        continue;
                    }

                    /* Normalize */
                    $data = trim($data);

                    if(!empty($data)) {
                        $data = explode(' ', $data);
                        $this->commands->trigger($data[0], $key, $data);
                    }
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

        private function disconnect($key)
        {
            socket_write($this->conn[$key], 'disconnect', strlen('disconnect'));
            unset($this->conn[$key]);
            $this->conn = array_values($this->conn);
        }

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
}