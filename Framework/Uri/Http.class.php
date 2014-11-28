<?php
namespace Framework\Uri {
    /**
     * Uri interface
     *
     * Used in order to create and evaluate a uri
     *
     * PHP Version 5.4
     *
     * @category   Uri
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Http implements \Framework\Uri\UriInterface {
        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct() {
        }

        /**
         * Get current uri
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getCurrent() {
            return 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];
        }

        /**
         * {@inheritdoc}
         */
        public static function create($data, $query = null) {
            $uri = '/' . rtrim(implode('/', $data), '/') . '.php';

            if(isset($query)) {
                $i = 0;
                foreach($query as $para) {
                    if($i == 0) {
                        $uri .= '?' . $para[0] . '=' . $para[1];
                        $i++;
                        continue;
                    }

                    $uri .= '&' . $para[0] . '=' . $para[1];
                }
            }

            return $uri;
        }

        /**
         * {@inheritdoc}
         */
        public static function isValid($uri) {
        }

        /**
         * {@inheritdoc}
         */
        public function parse($uri) {
        }

        /**
         * {@inheritdoc}
         */
        public function toString() {
        }

        /**
         * {@inheritdoc}
         */
        public function resolve($base) {
        }
    }
}