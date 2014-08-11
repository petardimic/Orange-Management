<?php
namespace Framework\Core {
    abstract class CacheType extends \Framework\Base\Enum {
        const INACTIVE = 0;
        const FILE = 1;
        const MEMCACHE = 2;
    }

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
    class Cache implements \Framework\Base\Singleton {
        /**
         * Caching type
         *
         * @var \Framework\Core\Cache\CacheType
         * @since 1.0.0
         */
        public $type = null;

        /**
         * Database
         *
         * @var \Framework\Core\Database
         * @since 1.0.0
         */
        private $db = null;

        /**
         * Memcache instance
         *
         * @var \Memcache
         * @since 1.0.0
         */
        private $memc = null;

        /**
         * Instance
         *
         * @var \Framework\Core\Cache
         * @since 1.0.0
         */
        protected static $instance = null;

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct() {
            $this->db = \Framework\Core\Database::getInstance();

            $cache_data = null;

            $sth = $this->db->con->prepare('SELECT `content` FROM `' . $this->db->prefix . 'settings` WHERE `id` = 1000000015');
            $sth->execute();
            $cache_data = $sth->fetchAll();

            $this->type = (int)$cache_data[0][0];
        }

        /**
         * Returns instance
         *
         * @return \Framework\Core\Cache
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Protect instance from getting copied from outside
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        protected function __clone() {
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
            if ($this->type !== \Framework\Core\CacheType::INACTIVE) {
                if (!$asarray) {
                    foreach ($var as $v_key => $val) {
                        $this->push($key . ':' . $v_key, $val);
                    }
                }

                if ($this->type === \Framework\Core\CacheType::MEMCACHE) {
                    $json = json_encode($var);

                    try {
                        if (!file_exists(__DIR__ . '/../../Cache/' . $key . '.json')) {
                            mkdir(__DIR__ . '/../../Cache', 0777, true);
                        }

                        file_put_contents(__DIR__ . '/../../Cache/' . $key . '.json', $json);
                    } catch (\Exception $e) {
                        return false;
                    }
                } else {
                    $this->memc->add($key, $var, 864000);
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
            if ($this->type === \Framework\Core\CacheType::FILE) {
                try {
                    $json = file_get_contents(__DIR__ . '/../../Cache/' . $key . '.json');

                    return json_decode($json, true);
                } catch (\Exception $e) {
                    return false;
                }
            } elseif ($this->type === \Framework\Core\CacheType::MEMCACHE) {
                return $this->memc->get($key);
            }

            return false;
        }
    }
}
