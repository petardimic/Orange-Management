<?php
namespace Framework\Socket\Client {
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
    class Client extends \Framework\Socket\SocketAbstract
    {
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
                $this->disconnect();
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
        }

        /**
         * {@inheritdoc}
         */
        public function run()
        {
            socket_connect($this->sock, $this->ip, $this->port);
            $i = 0;

            while($this->run) {
                $i++;
                $msg = "disconnect";
                socket_write($this->sock, $msg, strlen($msg));

                $read = [$this->sock];

                //if(socket_select($read, $write = null, $except = null, 0) < 1) {
                    // error
                    // socket_last_error();
                    // socket_strerror(socket_last_error());
                //}

                if(count($read) > 0) {
                    $data = socket_read($this->sock, 1024);

                    /* Server no data */
                    if($data === false) {
                        continue;
                    }

                    /* Normalize */
                    $data = trim($data);

                    if(!empty($data)) {
                        $data = explode(' ', $data);
                        $this->commands->trigger($data[0], 0, $data);
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

        /**
         * Disconnect from server
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function disconnect()
        {
            $this->run = false;
        }
    }
}