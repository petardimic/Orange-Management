<?php
namespace Framework\DataStorage\Cache {
    /**
     * Cache class
     *
     * Responsible for caching scalar data types and arrays.
     * Caching HTML output and objects coming soon/is planned.
     *
     * PHP Version 5.4
     *
     * @category   DataStorage
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Cache implements \Framework\DataStorage\Cache\CacheInterface, \Framework\Config\OptionsInterface {
        /**
         * MemCache instance
         *
         * @var \Framework\DataStorage\Cache\MemCache
         * @since 1.0.0
         */
        private $memc = null;

        /**
         * FileCache instance
         *
         * @var \Framework\DataStorage\Cache\FileCache
         * @since 1.0.0
         */
        private $filec = null;

        /**
         * Application instance
         *
         * @var \Framework\WebApplication
         * @since 1.0.0
         */
        private $app = null;

        /**
         * Options array
         *
         * @var mixed[]
         * @since 1.0.0
         */
        private $options = [];

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app) {
            $this->app = $app;
        }

        /**
         * Requesting caching instance
         *
         * @param \Framework\DataStorage\Cache\CacheType $type Cache to request
         *
         * @return \Framework\DataStorage\Cache\MemCache|\Framework\DataStorage\Cache\FileCache|null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function get_instance($type = null) {
            if(($type === null || $type === \Framework\DataStorage\Cache\CacheType::MEMCACHE) && $this->memc !== null) {
                return $this->memc;
            }

            if(($type === null || $type === \Framework\DataStorage\Cache\CacheType::FILECACHE) && $this->filec !== null) {
                return $this->memc;
            }

            return null;
        }

        /**
         * Init cache
         *
         * @param mixed $options Options used to initialize the different caching types
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function init($options = null) {
            if($options === null) {
                /* This is costing me 1ms, maybe init settings first cause i'm making another settings call later on -> same call 2 times */
                $sth = $this->app->db->con->prepare('SELECT `content` FROM `' . $this->app->db->prefix . 'settings` WHERE `id` = 1000000015');
                $sth->execute();
                $cache_data = $sth->fetchAll();

                $this->set_option('cache:type', (int)$cache_data[0][0]);
            } else {
                $this->options = $options;
            }
        }

        /**
         * Updating or adding settings
         *
         * @param mixed $key Unique option key
         * @param mixed $value Option value
         * @param bool $storable Is this option storable inside DB or cache
         * @param bool $save Should this update the database/cache
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function set_option($key, $value, $storeable = false, $save = false) {
            $this->options[$key] = [$value, $storable];
        }

        /**
         * Get option by key
         *
         * @param mixed $key Unique option key
         *
         * @return mixed Option value
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function get_option($key) {
            return (isset($this->options[$key]) ? $this->options[$key] : null);
        }

        /**
         * Update options (push them into DB and Cache)
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function update() {}

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
            $this->get_instance($type)->set($key, $value, $type = null, $expire);
        }

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
        public function add($key, $value, $type = null, $expire = 2592000) {
            return $this->get_instance($type)->add($key, $value, $type = null, $expire);
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
            return $this->get_instance($type)->get($key);
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
            $this->get_instance($type)->delete($key);
        }

        /**
         * Removing all elements from cache (invalidate cache)
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function flush() {
            if($type === null) {
                $this->filec->flush();
                $this->memc->flush();
            } elseif($type === \Framework\DataStorage\Cache\CacheType::MEMCACHE) {
                $this->memc->flush();
            } elseif($type === \Framework\DataStorage\Cache\CacheType::FILECACHE) {
                $this->filec->flush();
            }
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
            $this->get_instance($type)->replace($key, $value);
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
            $stats = [];

            if($this->memc !== null) {
                $stats['memc'] = $this->memc->stats();
            }

            if($this->filec !== null) {
                $stats['filec'] = $this->filec->stats();
            }

            return $stats;
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
            $threshold = [];

            if($this->memc !== null) {
                $threshold['memc'] = $this->memc->get_threshold();
            }

            if($this->filec !== null) {
                $threshold['filec'] = $this->filec->get_threshold();
            }

            return $threshold;
        }
    }
}
