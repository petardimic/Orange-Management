<?php
namespace Framework\Socket {
    /**
     * Socket class
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
    abstract class Server implements \Framework\Socket\SocketInterface {
        private $server_ip = null;
        private $server_port = null;
        private $run = true;

        private $sock = null;

        public function __construct() {
            
        }

        public function create($ip, $port) {
            $this->ip = $ip;
            $this->port = $port; 

            $this->sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            socket_bind($this->sock, $this->server_ip, $this->port);          
        }

        private function close() {
            if($this->sock !== null) {
                socket_close($this->sock);
                $this->sock = null;
            }
        }

        public function __destruct() {
            $this->close();
        }
    }
}