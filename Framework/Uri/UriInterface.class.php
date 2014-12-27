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
    interface UriInterface
    {
        /**
         * Create URI
         *
         * @param string[] $data  Parameters
         * @param string[] $query Query
         *
         * @return string
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
         * @return bool
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function isValid($uri);

        /**
         * Make string to Uri
         *
         * @param string $uri Uri string
         *
         * @return \Framework\Uri\UriInterface
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function parse($uri);

        /**
         * Make Uri to string
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function toString();

        /**
         * Make relative path absolute
         *
         * @param string $base Base uri
         *
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function resolve($base);
    }
}