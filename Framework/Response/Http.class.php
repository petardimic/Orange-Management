<?php
namespace Framework\Response {
    /**
     * Response class
     *
     * PHP Version 5.4
     *
     * @category   Framework
     * @package    Framework\Request
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Http
    {
        private $header = [];

        private $response = [];

        private $autoPush = false;

        public function addHeader($key, $header)
        {
            $this->header[$key] = $header;
        }

        public function pushHeader()
        {
            foreach($this->header as $ele) {
                header($ele, true);
            }
        }

        public function removeHeader($key)
        {
            unset($this->header[$key]);
        }

        public function setResponse($response)
        {
            $this->response = $response;
        }

        public function addResponse($response)
        {
            $this->response[] = $response;

            if($this->autoPush) {
                $this->pushResponseId(count($this->response));
            }
        }

        public function getResponse($id)
        {
            return $this->response[$id];
        }

        public function removeResponse($id)
        {
            unset($this->response[$id]);
        }

        public function pushResponse()
        {
            ob_start();

            foreach($this->response as $key => $response) {
                echo $this->response[$key];
            }

            ob_end_flush();
        }

        public function pushResponseId($id)
        {
            ob_start();
            echo $this->response[$id];
            ob_end_flush();
        }

        public function setAutoPush($push)
        {
            $this->autoPush = $push;
        }
    }
}