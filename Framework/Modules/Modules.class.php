<?php
namespace Framework\Modules {
    /**
     * Modules class
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
    class Modules {
        /**
         * Database object
         *
         * @var \Framework\Core\Database
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
         * Localization instance
         *
         * @var \Framework\Localization\Localization
         * @since 1.0.0
         */
        public $localization = null;

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
         * @var \Framework\Modules\ModuleAbstract[]
         * @since 1.0.0
         */
        public $running = [];

        /**
         * Installed Modules
         *
         * @var array
         * @since 1.0.0
         */
        public $installed = null;

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
            $this->db           = \Framework\Core\Database::getInstance();
            $this->cache        = \Framework\Core\Cache::getInstance();
            $this->localization = \Framework\Localization\Localization::getInstance(-1);
        }

        /**
         * Returns instance
         *
         * @return \Framework\Modules\Modules
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
         * Load all modules for this request
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function modules_load() {
            $request      = \Framework\Core\Request::getInstance();
            $this->loaded = $this->cache->pull('modules:loaded' . $request->uri_hash[3]);

            if (!$this->loaded) {
                $sth = $this->db->con->prepare(
                    'SELECT
                        `' . $this->db->prefix . 'modules_load`.`type`, `' . $this->db->prefix . 'modules_load`.*
                    FROM
                        `' . $this->db->prefix . 'modules_load`
                    WHERE
                        `pid` IN(:pid1, :pid2, :pid3, :pid4)'
                );

                $sth->bindValue(':pid1', $request->uri_hash[0], \PDO::PARAM_STR);
                $sth->bindValue(':pid2', $request->uri_hash[1], \PDO::PARAM_STR);
                $sth->bindValue(':pid3', $request->uri_hash[2], \PDO::PARAM_STR);
                $sth->bindValue(':pid4', $request->uri_hash[3], \PDO::PARAM_STR);
                $sth->execute();
                $this->loaded = $sth->fetchAll(\PDO::FETCH_GROUP);

                $this->cache->push('modules:loaded' . $request->uri_hash[3], $this->loaded);
            }

            $this->active = $this->cache->pull('modules:active');

            if (!$this->active) {
                $sth = $this->db->con->prepare(
                    'SELECT
                        `' . $this->db->prefix . 'modules`.`id`, `' . $this->db->prefix . 'modules`.*
                    FROM
                        `' . $this->db->prefix . 'modules`
                    WHERE
                        `active` = 1'
                );
                $sth->execute();

                $this->active = $sth->fetchAll(\PDO::FETCH_GROUP | \PDO::FETCH_UNIQUE);
                $this->cache->push('modules:active', $this->active);
            }

            ModuleFactory::$available = $this->active;
            $this->running            = & ModuleFactory::$initialized;

            if (isset($this->loaded[5])) {
                \Framework\Localization\Localization::language_load($this->localization->language, $this->loaded[5]);
            }

            if (isset($this->loaded[4])) {
                /* TODO: Maybe pass array, reduces function call */
                foreach ($this->loaded[4] as $class) {
                    ModuleFactory::getInstance($class['from']);
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
                $this->installed = $this->cache->pull('modules::installed');

                if (!$this->installed) {
                    $sth = $this->db->con->prepare('SELECT `id`,`name` FROM `' . $this->db->prefix . 'modules` WHERE `active` = 1');
                    $sth->execute();
                    $this->installed = $sth->fetchAll(\PDO::FETCH_KEY_PAIR);

                    $this->cache->push('modules::installed', $this->installed);
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

            switch ($this->db->type) {
                case \Framework\Core\DatabaseType::MYSQL:
                    $search = $this->db->generate_sql_filter($filter);

                    $sth = $this->db->con->prepare(
                        'SELECT SQL_CALC_FOUND_ROWS * FROM `' . $this->db->prefix . 'modules` ' . $search . 'LIMIT ' . $offset . ',' . $limit
                    );
                    $sth->execute();

                    $result['list'] = $sth->fetchAll();

                    $sth = $this->db->con->prepare(
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
            $sth = $this->db->con->prepare('SELECT `' . $this->db->prefix . 'modules`.`id`, `' . $this->db->prefix . 'modules`.* FROM `' . $this->db->prefix . 'modules` WHERE `active` = 0');
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
            $active = $this->cache->pull('modules:active');

            if (!$active) {
                $sth = $this->db->con->prepare('SELECT `' . $this->db->prefix . 'modules`.`id`, `' . $this->db->prefix . 'modules`.* FROM `' . $this->db->prefix . 'modules` WHERE `active` = 1');
                $sth->execute();
                $active = $sth->fetchAll(\PDO::FETCH_GROUP | \PDO::FETCH_UNIQUE);

                $this->cache->push('modules:active', $active);
            }

            return $active;
        }
    }
}
