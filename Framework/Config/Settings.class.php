<?php
// TODO: Maybe remove this class entirely
namespace Framework\Config {
    /**
     * Settings class
     *
     * Responsible for all application and module configurations.
     * This class can load and save settings based on their ids.
     * Creating new settings is not possible, this has to be done during the module installation.
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
    class Settings {
        /**
         * Application instance
         *
         * @var \Framework\WebApplication
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
        public function loadSettings($ids) {
            foreach ($ids as $id) {
                if (isset($this->config[$id])) {
                    unset($ids[$id]);
                } 
            }

            // TODO: implement cache if cache is initialized
            if (!empty($ids)) {
                $sth = $this->app->db->con->prepare('SELECT `id`, `content` FROM `' . $this->app->db->prefix . 'settings` WHERE `id` IN (' . implode(',', $ids) . ')');
                $sth->execute();
                $cfgs = $sth->fetchAll(\PDO::FETCH_KEY_PAIR);
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
        public function setSettings($settings) {
            $this->config += $settings;

            /* TODO: change this + implement cache */
            foreach ($settings as $key => $value) {
                $sth = $this->app->db->con->prepare('UPDATE `' . $this->app->db->prefix . 'settings` SET `content` = \'' . $value . '\' WHERE `id` = ' . $key);
                $sth->execute();
            }
        }
    }
}
