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
    class Irc implements \Framework\Uri\UriInterface
    {
        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct()
        {
        }

        /**
         * {@inheritdoc}
         */
        public static function create($data, $query = null)
        {
            return null;
        }

        /**
         * {@inheritdoc}
         */
        public static function isValid($uri)
        {
            return true;
        }

        /**
         * {@inheritdoc}
         */
        public function parse($uri)
        {
        }

        /**
         * {@inheritdoc}
         */
        public function toString()
        {
        }

        /**
         * {@inheritdoc}
         */
        public function resolve($base)
        {
        }
    }
}