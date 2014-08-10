<?php
namespace Framework\Core {
    /**
     * Settings class
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
    class Settings implements \Framework\Base\Singleton {
        /**
         * Database object
         *
         * @var \Framework\Core\Database\Database
         * @since 1.0.0
         */
        private $db = null;

        /**
         * Cache instance
         *
         * @var \Framework\Core\Cache
         * @since 1.0.0
         */
        public $cache = null;

        /**
         * Config
         *
         * @var array
         * @since 1.0.0
         */
        public $config = [];

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
        private function __construct() {
            $this->db    = \Framework\Core\Database\Database::getInstance();
            $this->cache = Cache::getInstance();
        }

        /**
         * Returns instance
         *
         * @return \Framework\Core\Settings
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
         * Loads settings
         *
         * @param array $ids Setting IDs
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function settings_load($ids) {
            foreach ($ids as $id) {
                if (isset($this->config[$id])) {
                    unset($ids[$id]);
                } else {
                    $cfg = $this->cache->pull('cfg:' . $id);

                    if ($cfg !== false) {
                        $this->config[$id] = $cfg;
                        unset($ids[$id]);
                    }
                }
            }

            if (!empty($ids)) {
                $sth = $this->db->con->prepare('SELECT `id`, `content` FROM `' . $this->db->prefix . 'settings` WHERE `id` IN (' . implode(',', $ids) . ')');
                $sth->execute();
                $cfgs = $sth->fetchAll(\PDO::FETCH_KEY_PAIR);

                $this->cache->push('cfg', $cfgs, false);
                $this->config += $cfgs;
            }
        }

        /**
         * Change settings
         *
         * @param array $settings Settings to set
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function settings_set($settings) {
        }
    }
}