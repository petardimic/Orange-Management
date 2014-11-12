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
        private $server_limit = null;

        private $clients = [];

        public function __construct() {
            parent::__construct();
        }

        public function create($ip, $port, $limit) {
            parent::create($ip, $port);

            $this->limit = $limit;
        }

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

                foreach ($read as $read_sock) {
                    $data = @socket_read($read_sock, 1024, PHP_NORMAL_READ);

                    /* Client disconnected */
                    if($data === false) {
                        $key = array_search($read_sock, $this->clients);
                        unset($this->clients[$key]);
                        continue;
                    }

                    /* Normalize */
                    $data = trim($data);

                    if (!empty($data)) {
                        // TODO: handle data
                    }
                }
            }

            $this->close();
        }

        private function close() {
            parent::close();
        }

        public function __destruct() {
            parent::__destruct();
        }
    }
}