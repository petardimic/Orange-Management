<?php
namespace Framework\Request {
    /**
     * Request interface
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
    interface RequestInterface {
        public function getRequestSource();

        public function setRequestSource($source);

        public function getRequest();

        public function getType();

        public function getRequestInfo();

        public function getUri();
    }
}