<?php
namespace Framework\Module {
    /**
     * Modules class
     *
     * General module functionality such as listings and initialization.
     *
     * PHP Version 5.4
     *
     * @category   Module
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class ModuleManager {
        /**
         * Application instance
         *
         * @var \Framework\WebApplication
         * @since 1.0.0
         */
        private $app = null;

        /**
         * Active Modules
         *
         * @var array
         * @since 1.0.0
         */
        public $active = [];

        /**
         * Loaded files
         *
         * @var array
         * @since 1.0.0
         */
        public $loaded = [];

        /**
         * Running modules
         *
         * @var \Framework\Module\ModuleAbstract[]
         * @since 1.0.0
         */
        public $running = [];

        /**
         * Installed modules
         *
         * @var array
         * @since 1.0.0
         */
        public $installed = null;

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
         * Load all modules for this request
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function modules_load() {
            $this->loaded = $this->app->cache->pull('modules:loaded' . $this->app->request->uri_hash[3]);

            if (!$this->loaded) {
                $sth = $this->app->db->con->prepare(
                    'SELECT
                        `' . $this->app->db->prefix . 'modules_load`.`type`, `' . $this->app->db->prefix . 'modules_load`.*
                    FROM
                        `' . $this->app->db->prefix . 'modules_load`
                    WHERE
                        `pid` IN(:pid1, :pid2, :pid3, :pid4)'
                );

                $sth->bindValue(':pid1', $this->app->request->uri_hash[0], \PDO::PARAM_STR);
                $sth->bindValue(':pid2', $this->app->request->uri_hash[1], \PDO::PARAM_STR);
                $sth->bindValue(':pid3', $this->app->request->uri_hash[2], \PDO::PARAM_STR);
                $sth->bindValue(':pid4', $this->app->request->uri_hash[3], \PDO::PARAM_STR);
                $sth->execute();
                $this->loaded = $sth->fetchAll(\PDO::FETCH_GROUP);

                $this->app->cache->push('modules:loaded' . $this->app->request->uri_hash[3], $this->loaded);
            }

            $this->active = $this->app->cache->pull('modules:active');

            if (!$this->active) {
                $sth = $this->app->db->con->prepare(
                    'SELECT
                        `' . $this->app->db->prefix . 'modules`.`id`, `' . $this->app->db->prefix . 'modules`.*
                    FROM
                        `' . $this->app->db->prefix . 'modules`
                    WHERE
                        `active` = 1'
                );
                $sth->execute();

                $this->active = $sth->fetchAll(\PDO::FETCH_GROUP | \PDO::FETCH_UNIQUE);
                $this->app->cache->push('modules:active', $this->active);
            }

            \Framework\Module\ModuleFactory::$available = $this->active;
            $this->running                              = & \Framework\Module\ModuleFactory::$initialized;

            if (isset($this->loaded[5])) {
                $this->app->user->localization->load_language($this->app->user->localization->language, $this->loaded[5]);
            }

            if (isset($this->loaded[4])) {
                /* TODO: Maybe pass array, reduces function call */
                foreach ($this->loaded[4] as $class) {
                    \Framework\Module\ModuleFactory::getInstance($class['from']);
                }
            }
        }

        /**
         * Get all installed modules
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function modules_installed_get() {
            if (!isset($this->installed)) {
                $this->installed = $this->app->cache->pull('modules::installed');

                if (!$this->installed) {
                    $sth = $this->app->db->con->prepare('SELECT `id`,`name` FROM `' . $this->app->db->prefix . 'modules` WHERE `active` = 1');
                    $sth->execute();
                    $this->installed = $sth->fetchAll(\PDO::FETCH_KEY_PAIR);

                    $this->app->cache->push('modules::installed', $this->installed);
                }
            }

            return $this->installed;
        }

        /**
         * Get all modules
         *
         * This function gets all modules located in /modules
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function module_list_all_get() {
            chdir(__DIR__ . '/../../Modules');
            $files     = glob('*', GLOB_ONLYDIR);
            $c         = count($files);
            $installed = null;

            for ($i = 0; $i < $c; $i++) {
                $path = __DIR__ . '/../../Modules/' . $files[$i] . '/info.json';

                if (file_exists($path)) {
                    $json                                 = json_decode(file_get_contents($path), true);
                    $installed[$json['name']['internal']] = $json;
                }
            }

            return $installed;
        }

        /**
         * Get all modules
         *
         * @param array $filter Filter for search results
         * @param int   $offset Offset for first account
         * @param int   $limit  Limit for results
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function module_list_installed_get($filter = null, $offset = 0, $limit = 100) {
            $result = null;

            switch ($this->app->db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $search = $this->app->db->generate_sql_filter($filter);

                    $sth = $this->app->db->con->prepare(
                        'SELECT SQL_CALC_FOUND_ROWS * FROM `' . $this->app->db->prefix . 'modules` ' . $search . 'LIMIT ' . $offset . ',' . $limit
                    );
                    $sth->execute();

                    $result['list'] = $sth->fetchAll();

                    $sth = $this->app->db->con->prepare(
                        'SELECT FOUND_ROWS();'
                    );
                    $sth->execute();

                    $result['count'] = $sth->fetchAll()[0][0];
                    break;
            }

            return $result;
        }

        /**
         * Get all inactive modules
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function modules_inactive_get() {
            $sth = $this->app->db->con->prepare('SELECT `' . $this->app->db->prefix . 'modules`.`id`, `' . $this->app->db->prefix . 'modules`.* FROM `' . $this->app->db->prefix . 'modules` WHERE `active` = 0');
            $sth->execute();

            return $sth->fetchAll(\PDO::FETCH_GROUP | \PDO::FETCH_UNIQUE);
        }

        /**
         * Get all active modules
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function modules_active_get() {
            $active = $this->app->cache->pull('modules:active');

            if (!$active) {
                $sth = $this->app->db->con->prepare('SELECT `' . $this->app->db->prefix . 'modules`.`id`, `' . $this->app->db->prefix . 'modules`.* FROM `' . $this->app->db->prefix . 'modules` WHERE `active` = 1');
                $sth->execute();
                $active = $sth->fetchAll(\PDO::FETCH_GROUP | \PDO::FETCH_UNIQUE);

                $this->app->cache->push('modules:active', $active);
            }

            return $active;
        }

        /**
         * Get all active modules
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function module_info_get($id) {
            if (!isset($this->installed[$id]['info'])) {
                $path = __DIR__ . '/../../Modules/' . $id . '/info.json';

                if (file_exists($path)) {
                    $this->installed[$id]['info'] = json_decode(file_get_contents($path), true);
                }
            }

            return $this->installed[$id]['info'];
        }
    }
}
