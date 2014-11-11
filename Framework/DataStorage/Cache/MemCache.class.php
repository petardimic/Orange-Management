<?php
namespace Framework\DataStorage\Cache {
    /**
     * Memcache class
     *
     * PHP Version 5.4
     *
     * @category   Cache
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class MemCache implements \Framework\DataStorage\Cache\CacheInterface {
        /**
         * Memcache instance
         *
         * @var \Memcache
         * @since 1.0.0
         */
        private $memc = null;

        /**
         * Only cache if data is larger than threshold (0-100)
         *
         * @var int
         * @since 1.0.0
         */
        private static $threshold = 10;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct() {
            $this->memc = new Memcache();
        }

        /**
         * Adding server to server pool
         *
         * @param mixed $data Server data array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function add_server($data) {
            $this->memc->addServer($data['host'], $data['port'], $data['timeout'])
        }

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
        public function set($key, $value, $type = null, $expire = 2592000) {
            $this->memc->set($key, $value, false, $expire)
        }

        /**
         * Updating or adding cache data
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
        public function add($key, $value, $type = null, $expire = 2592000) {
            return $this->memc->add($key, $value, false, $expire)
        }

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
        public function get($key) {
            return $this->memc->get($key);
        }

        /**
         * Remove value by key
         *
         * @param mixed $key Unique cache key
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function delete($key) {
            $this->memc->delete($key);
        }

        /**
         * Removing all elements from cache (invalidate cache)
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function flush() {
            $this->memc->flush();
        }

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
        public function replace($key, $value, $type = null) {
            $this->memc->replace($key, $value, false, $expire)
        }

        /**
         * Requesting cache stats
         *
         * @return mixed[] Stats array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function stats() {
            return $this->memc->getExtendedStats();
        }

        /**
         * Get the threshold required to cache data using this cache
         *
         * @return int Storage threshold
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function get_threshold() {
            return self::$threshold;
        }

        /**
         * Closing cache
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function close() {
            if($this->memc !== null) {
                $this->memc->close();
                $this->memc = null;
            }
        }

        /**
         * Destructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __destruct() {
            $this->close();
        }
    }
}