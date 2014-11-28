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
         * @var \Framework\Uri\UriInterface
         * @since 1.0.0
         */
        public $uri = null;

        /**
         * Language
         *
         * @var string
         * @since 1.0.0
         */
        protected $lang = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct() {
        }

        /**
         * {@inheritdoc}
         */
        public function getUri() {
            return $this->uri;
        }

        /**
         * {@inheritdoc}
         */
        public function getRequestSource() {
           return self::$source;
        }

        /**
         * {@inheritdoc}
         */
        public function setRequestSource($source) {
            self::$source = $source;
        }

        /**
         * {@inheritdoc}
         */
        public function getType() {
            return $this->type;
        }

        /**
         * {@inheritdoc}
         */
        public function getLanguage() {
            return $this->lang;
        }
    }
}