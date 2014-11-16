<?php
namespace Framework\Request {
    /**
     * Request class
     *
     * PHP Version 5.4
     *
     * @category   Request
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Web extends \Framework\Request\RequestAbstract {
        /**
         * Request information
         *
         * @var string[]
         * @since 1.0.0
         */
        private $request_info = null;

        /**
         * Request
         *
         * @var array
         * @since 1.0.0
         */
        private $request = null;

        /**
         * Request hash
         *
         * @var array
         * @since 1.0.0
         */
        private $hash = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct() {
            parent::__construct();
            $this->uri = new \Framework\Uri\Http();
            $this->getRequest();
        }

        /**
         * Get request
         *
         * @return array $request_info (Browser and OS data)
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getRequest() {
            if($this->request === null) {
                $this->request = file_get_contents("php://input");
            }

            return $this->request;
        }

        /**
         * Get request information
         *
         * @return array $request_info (Browser and OS data)
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getRequestInfo() {
            if($this->request_info === null) {
                /* Get browser */
                $arr = \Framework\Request\BrowserType::getConstants();

                $http_request_type = strtolower($_SERVER['HTTP_USER_AGENT']);

                foreach ($arr as $key => $val) {
                    if (stripos($http_request_type, $val)) {
                        $request_info['browser'] = $val;
                        break;
                    }
                }

                /* Get OS */
                $arr = \Framework\Request\OSType::getConstants();

                $http_request_type = strtolower($_SERVER['HTTP_USER_AGENT']);

                foreach ($arr as $key => $val) {
                    if (stripos($http_request_type, $val)) {
                        $request_info['os'] = $val;
                        break;
                    }
                }
            }

            return $this->request_info;
        }

        /**
         * Get request hashes
         *
         * @return array Request hashes
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getHash() {
            return $this->hash;
        }
    }
}