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
    abstract class RequestAbstract implements \Framework\Request\RequestInterface {
        /**
         * Request type
         *
         * @var \Framework\Request\RequestType
         * @since 1.0.0
         */
        protected $type = null;

        /**
         * Request type
         *
         * @var \Framework\Request\RequestSource
         * @since 1.0.0
         */
        private static $source = null;

        /**
         * Uri
         *
         * @var \Framework\Uri\UriAbstract
         * @since 1.0.0
         */
        public $uri = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct() {
        }

        /**
         * Get request
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getUri() {
            return $this->uri;
        }

        /**
         * Get request source
         *
         * @return \Framework\Request\RequestSource
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getRequestSource() {
           return self::$source;
        }

        /**
         * Get request source
         *
         * @param \Framework\Request\RequestSource $source Source of the request
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setRequestSource($source) {
            self::$source = $source;
        }

        /**
         * Get request type
         *
         * @return \Framework\Request\RequestType
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getType() {
            return $this->type;
        }
    }
}