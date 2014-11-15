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
    class Web {
        private $request_info = null;

        public function __construct() {

        }

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

        public function createRequest($para, $type = null) {
            
        }
    }
}