<?php
namespace Framework\Config {
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
    class Settings {
        /**
         * Application instance
         *
         * @var \Framework\Application
         * @since 1.0.0
         */
        private $app = null;

        /**
         * Config
         *
         * @var array
         * @since 1.0.0
         */
        public $config = [];

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
         * Loads settings
         *
         * @param array $ids Setting IDs
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function load_settings($ids) {
            foreach ($ids as $id) {
                if (isset($this->config[$id])) {
                    unset($ids[$id]);
                } else {
                    $cfg = $this->app->cache->pull('cfg:' . $id);

                    if ($cfg !== false) {
                        $this->config[$id] = $cfg;
                        unset($ids[$id]);
                    }
                }
            }

            if (!empty($ids)) {
                $sth = $this->app->db->con->prepare('SELECT `id`, `content` FROM `' . $this->app->db->prefix . 'settings` WHERE `id` IN (' . implode(',', $ids) . ')');
                $sth->execute();
                $cfgs = $sth->fetchAll(\PDO::FETCH_KEY_PAIR);

                /* TODO: this overwrites old cfgs, which shouldn't happen */
                $this->app->cache->push('cfg', $cfgs, false);
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
            $this->config += $settings;

            /* TODO: change this */
            foreach ($settings as $key => $value) {
                $sth = $this->app->db->con->prepare('UPDATE `' . $this->app->db->prefix . 'settings` SET `content` = \'' . $value . '\' WHERE `id` = ' . $key);
                $sth->execute();
            }
        }
    }
}
