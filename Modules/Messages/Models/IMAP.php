<?php
namespace Modules\Messages;
    /**
     * IMAP class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Messages
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class IMAP implements \Modules\Messages\Email
    {
        private $con = null;

        public function __construct()
        {
        }

        public function connect($host, $port, $user, $password)
        {
            $this->con = imap_open('{' . $host . ':' . $port . '}', $user, $password);
        }

        public function getListNew()
        {
            // TODO: Implement getListNew() method.
        }

        public function getListAll()
        {
            // TODO: Implement getListAll() method.
        }

        public function getMessage()
        {
            // TODO: Implement getMessage() method.
        }

        public function removeMessage()
        {
            // TODO: Implement removeMessage() method.
        }

        public function setStatus()
        {
            // TODO: Implement setStatus() method.
        }
    }