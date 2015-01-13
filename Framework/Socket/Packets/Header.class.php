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
    class Header implements \Serializable
    {
        private $sendFrom = null;

        private $sendTo = null;

        private $length = 0;

        private $type = 0;

        private $subtype = 0;

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getSendFrom()
        {
            return $this->sendFrom;
        }

        /**
         * @param null $sendFrom
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setSendFrom($sendFrom)
        {
            $this->sendFrom = $sendFrom;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getSendTo()
        {
            return $this->sendTo;
        }

        /**
         * @param null $sendTo
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setSendTo($sendTo)
        {
            $this->sendTo = $sendTo;
        }

        /**
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getLength()
        {
            return $this->length;
        }

        /**
         * @param int $length
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setLength($length)
        {
            $this->length = $length;
        }

        /**
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getType()
        {
            return $this->type;
        }

        /**
         * @param int $type
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setType($type)
        {
            $this->type = $type;
        }



        public function __toString()
        {
            return '';
        }

        public function serialize()
        {
            return $this->__toString();
        }

        public function unserialize($string)
        {
        }
    }
}