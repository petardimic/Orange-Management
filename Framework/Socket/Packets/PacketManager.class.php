<?php
namespace Framework\Socket\Packets {
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
    class PacketManager
    {
        private $commandManager = null;
        private $clientManager  = null;

        public function __construct($cmd, $user)
        {
            $this->commandManager = $cmd;
            $this->clientManager  = $user;
        }

        public function handle($data, $key)
        {
            if(!empty($data)) {
                $data = explode(' ', $data);
                $this->commandManager->trigger($data[0], $key, $data);
            } else {
                $this->commandManager->trigger('empty', $key, $data);
            }
        }
    }
}