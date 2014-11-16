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
    interface UriInterface {
        /**
         * Create URI
         *
         * @param string $data Parameters
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function create($data, $query = null);

        /**
         * Validate URI
         *
         * @param string $uri URI to validate
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function isValid($uri);

        public function parse($uri);

        public function toString();

        // make relative absolute
        public function resolve($base);
    }
}