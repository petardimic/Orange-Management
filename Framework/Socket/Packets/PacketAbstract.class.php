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
    abstract class PacketAbstract implements \Serializable
    {
        /**
         * Packet header
         *
         * @var \Framework\Socket\Packets\Header
         * @since 1.0.0
         */
        private $header = null;

        abstract public function __toString();

        public function getHeader()
        {
            return $this->header;
        }

        public function setHeader($header)
        {
            $this->header = $header;
        }
    }
}