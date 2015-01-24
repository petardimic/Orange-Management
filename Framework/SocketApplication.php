<?php
namespace Framework;
    /**
     * Controller class
     *
     * PHP Version 5.4
     *
     * @category   App
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class SocketApplication extends \Framework\ApplicationAbstract
    {
        private $type;

        /**
         * Constructor
         *
         * @param array $config Core config
         * @param int   $type   Socket type
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($config, $type)
        {
            $this->type = $type;
            $socket = null;

            if($type == \Framework\Socket\SocketType::SERVER) {
                // TODO: load all modules + other stuff

                $socket = new \Framework\Socket\Server\Server();
                $socket->create('127.0.0.1', $config['socket']['port']);
                $socket->setLimit($config['socket']['limit']);
            } elseif($type == \Framework\Socket\SocketType::CLIENT) {
                $socket = new \Framework\Socket\Client\Client();
                $socket->create('127.0.0.1', $config['socket']['port']);
            } else {
                exit();
            }

            $socket->run();
        }
    }
