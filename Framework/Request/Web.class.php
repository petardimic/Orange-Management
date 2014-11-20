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
        public $request = null;

        /**
         * Request hash
         *
         * @var array
         * @since 1.0.0
         */
        private $hash = null;

        /**
         * Request language
         *
         * @var string
         * @since 1.0.0
         */
        public $lang = 'en';

        /**
         * Browser type
         *
         * @var \Framework\Http\BrowserType
         * @since 1.0.0
         */
        public $browser = null;

        /**
         * OS type
         *
         * @var \Framework\Http\OSType
         * @since 1.0.0
         */
        public $os = null;

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
                $this->request = [
                    'l0' => '',
                    'l1' => '',
                    'l2' => '',
                    'l3' => '',
                    'l4' => '',
                    'l5' => '',
                    'l6' => '',
                    'l7' => '',
                ];

                $this->request = (isset($_GET) ? $_GET : file_get_contents("php://input")) + $this->request;
                $this->type = $this->request['l1'];
                $this->lang = $this->request['l0'];

                $this->hash = [
                    $this->hashRequest([$this->request['l1']]),
                    $this->hashRequest([$this->request['l1'], $this->request['l2']]),
                    $this->hashRequest([$this->request['l1'], $this->request['l2'], $this->request['l3']]),
                    $this->hashRequest([$this->request['l1'], $this->request['l2'], $this->request['l3'], $this->request['l4']]),
                    $this->hashRequest([$this->request['l1'], $this->request['l2'], $this->request['l3'], $this->request['l4'], $this->request['l5']]),
                ];
            }

            return $this->request;
        }

        /**
         * Generate request hash
         *
         * @param array $request Request array
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function hashRequest($request) {
            return sha1(implode('', $request));
        }

        /**
         * Determine request browser
         *
         * @return \Framework\Http\BrowserType
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getBrowser() {
            if ($this->browser == null) {
                $arr = BrowserType::getConstants();

                $http_request_type = strtolower($_SERVER['HTTP_USER_AGENT']);

                foreach ($arr as $key => $val) {
                    if (stripos($http_request_type, $val)) {
                        $this->browser = $val;
                        break;
                    }
                }
            }

            return $this->browser;
        }

        /**
         * Determine request OS
         *
         * @return \Framework\Http\OSType
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getOS() {
            if ($this->os == null) {
                $arr = OSType::getConstants();

                $http_request_type = strtolower($_SERVER['HTTP_USER_AGENT']);

                foreach ($arr as $key => $val) {
                    if (stripos($http_request_type, $val)) {
                        $this->os = $val;
                        break;
                    }
                }
            }

            return $this->os;
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
               $this->request_info['browser'] = $this->getBrowser();
               $this->request_info['os'] = $this->getOS();
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