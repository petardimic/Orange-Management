<?php
/* NOT IN USE */
/* TODO: implement */
namespace Framework\Http {
    /**
     * Response class
     *
     * NOT IN USE - Maybe implement especially for API responses?!?!?!
     *
     * PHP Version 5.4
     *
     * @category   Http
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Response {
        public $type = null;
        public $msg_text = null;
        public $msg_level = null;
        public $data = null;

        public function __construct() {
        }

        public function create($id) {
        }

        public function send() {
        }
    }
}