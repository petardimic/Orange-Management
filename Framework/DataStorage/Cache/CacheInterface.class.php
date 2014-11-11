<?php
namespace Framework\DataStorage\Cache {
    /**
     * Cache interface
     *
     * PHP Version 5.4
     *
     * @category   Config
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    interface CacheInterface {
        /**
         * Updating or adding cache data
         *
         * @param mixed $key Unique cache key
         * @param mixed $value Cache value
         * @param \Framework\DataStorage\CacheType $type Cache type
         * @param int $expire Valid duration (in s)
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function set($key, $value, $type = null, $expire = 2592000);

        /**
         * Adding new data if it doesn't exist
         *
         * @param mixed $key Unique cache key
         * @param mixed $value Cache value
         * @param \Framework\DataStorage\CacheType $type Cache type
         * @param int $expire Valid duration (in s)
         *
         * @param bool Successful or not?
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function add($key, $value, $type = null, $expire = 2592000);

        /**
         * Get cache by key
         *
         * @param mixed $key Unique cache key
         *
         * @return mixed Cache value
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function get($key);

        /**
         * Remove value by key
         *
         * @param mixed $key Unique cache key
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function delete($key);

        /**
         * Removing all elements from cache (invalidate cache)
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function flush();

        /**
         * Updating existing value/key
         *
         * @param mixed $key Unique cache key
         * @param mixed $value Cache value
         * @param \Framework\DataStorage\CacheType $type Cache type
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function replace($key, $value, $type = null);

        /**
         * Requesting cache stats
         *
         * @return mixed[] Stats array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function stats();

        /**
         * Get the threshold required to cache data using this cache
         *
         * @return int Storage threshold
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function get_threshold();
    }
}