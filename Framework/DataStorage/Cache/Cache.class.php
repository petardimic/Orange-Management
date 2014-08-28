<?php
namespace Framework\DataStorage\Cache {
    /**
     * Cache class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Cache {
        /**
         * Caching type
         *
         * @var \Framework\DataStorage\Cache\Cache\CacheType
         * @since 1.0.0
         */
        public $type = null;

        /**
         * Memcache instance
         *
         * @var \Memcache
         * @since 1.0.0
         */
        private $memc = null;

        /**
         * Application instance
         *
         * @var \Framework\Application
         * @since 1.0.0
         */
        private $app = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($app) {
            $this->app = $app;

            /* This is costing me 1ms, maybe init settings first cause i'm making another settings call later on -> same call 2 times */
            $sth = $this->app->db->con->prepare('SELECT `content` FROM `' . $this->app->db->prefix . 'settings` WHERE `id` = 1000000015');
            $sth->execute();
            $cache_data = $sth->fetchAll();

            $this->type = (int)$cache_data[0][0];
        }

        public function start_cache_page_element($url, $id) {
            ob_flush();
            ob_end_clean();
            ob_start();
        }

        public function end_cache_page_element($url, $id) {
            $buffer = ob_getcontents();
            ob_end_clean();
            echo $buffer;

            file_put_contents(__DIR__ . '/../../Cache/Page/' . $id . $url . '.tmp');
        }

        public function get_cache_page_element($url, $id) {
            return file_get_contents(__DIR__ . '/../../Cache/Page/' . $id . $url . '.tmp');
        }

        /**
         * Caches data
         *
         * @param array $key     Key for caching
         * @param       $var
         * @param bool  $asarray Store variable as array
         *
         * @return boolean
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function push($key, $var, $asarray = true) {
            if ($this->type !== \Framework\DataStorage\Cache\CacheType::INACTIVE) {
                if (!$asarray) {
                    foreach ($var as $v_key => $val) {
                        $this->push($key . ':' . $v_key, $val);
                    }
                }

                switch ($this->type) {
                    case \Framework\DataStorage\Cache\CacheType::FILE:
                        $json = json_encode($var);

                        try {
                            if (!file_exists(__DIR__ . '/../../Cache/' . $key . '.json')) {
                                mkdir(__DIR__ . '/../../Cache', 0777, true);
                            }

                            file_put_contents(__DIR__ . '/../../Cache/' . $key . '.json', $json);
                        } catch (\Exception $e) {
                            return false;
                        }
                        break;
                    case \Framework\DataStorage\Cache\CacheType::MEMCACHE:
                        $this->memc->add($key, $var, 864000);
                        break;
                }
            }

            return true;
        }

        /**
         * Loads cached data
         *
         * @param array $key Key for caching
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function pull($key) {
            if ($this->type === \Framework\DataStorage\Cache\CacheType::FILE) {
                try {
                    $json = file_get_contents(__DIR__ . '/../../Cache/' . $key . '.json');

                    return json_decode($json, true);
                } catch (\Exception $e) {
                    return false;
                }
            } elseif ($this->type === \Framework\DataStorage\Cache\CacheType::MEMCACHE) {
                return $this->memc->get($key);
            }

            return false;
        }
    }
}
