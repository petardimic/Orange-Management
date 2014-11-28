<?php
namespace Framework\Socket {
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
    class Server extends \Framework\Socket\SocketAbstract {
        /**
         * Socket connection limit
         *
         * @var int
         * @since 1.0.0
         */
        private $limit = 10;

        /**
         * Clients
         *
         * @var resource
         * @since 1.0.0
         */
        private $clients = [];

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct() {
        }

        /**
         * {@inheritdoc}
         */
        public function create($ip, $port) {
            parent::create($ip, $port);
        }

        /**
         * Set connection limit
         *
         * @param int $limit Connection limit
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setLimit($limit) {
            $this->limit = $limit;
        }

        /**
         * {@inheritdoc}
         */
        public function run() {
            socket_listen($this->sock);
            socket_set_nonblock($this->sock);

            while($this->run) {
                $read = $this->clients;

                if(socket_select($read, $write = null, $except = null, 0) < 1) {
                    continue;
                }

                if(in_array($this->sock, $read)) {
                    $this->clients[] = $newc = socket_accept($this->sock);

                    socket_write($newc, 'msg to new client');
                    socket_getpeername($newc, $ip);

                    $key = array_search($this->sock, $read);
                    unset($read[$key]);
                }

                foreach($read as $read_sock) {
                    $data = @socket_read($read_sock, 1024, PHP_NORMAL_READ);

                    /* Client disconnected */
                    if($data === false) {
                        $key = array_search($read_sock, $this->clients);
                        unset($this->clients[$key]);
                        continue;
                    }

                    /* Normalize */
                    $data = trim($data);

                    if(!empty($data)) {
                        // TODO: handle data
                    }
                }
            }

            $this->close();
        }

        /**
         * {@inheritdoc}
         */
        public function close() {
            parent::close();
        }

        /**
         * {@inheritdoc}
         */
        public function __destruct() {
            parent::__destruct();
        }
    }
}