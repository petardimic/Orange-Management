<?php
namespace Framework\Socket\Packets;
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

        /**
         * Stringify packet
         *
         * This is using a json format
         *
         * @var \Framework\Socket\Packets\Header
         * @since 1.0.0
         */
        abstract public function __toString();

        /**
         * Stringify packet
         *
         * This is using a json format
         *
         * @return string Json string
         *
         * @var \Framework\Socket\Packets\Header
         * @since 1.0.0
         */
        abstract public function serialize();

        /**
         * Unserialize packet
         *
         * This is using a json format
         *
         * @param string $string Json string
         *
         * @var \Framework\Socket\Packets\Header
         * @since 1.0.0
         */
        abstract public function unserialize($string);

        /**
         * Get packet header
         *
         * @return \Framework\Socket\Packets\Header
         *
         * @var \Framework\Socket\Packets\Header
         * @since 1.0.0
         */
        public function getHeader()
        {
            return $this->header;
        }

        /**
         * Set packet header
         *
         * @param \Framework\Socket\Packets\Header $header Header
         *
         * @var \Framework\Socket\Packets\Header
         * @since 1.0.0
         */
        public function setHeader($header)
        {
            $this->header = $header;
        }
    }