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
         * Installed modules
         *
         * @var array
         * @since 1.0.0
         */
        private $installed = null;

        /**
         * All active modules (on all pages not just the ones that are running now)
         *
         * @var array
         * @since 1.0.0
         */
        private $active = null;

        /**
         * All modules in the module directory
         *
         * @var array
         * @since 1.0.0
         */
        private $all = null;

        /**
         * All modules that are running on this uri
         *
         * @var array
         * @since 1.0.0
         */
        public $running = null;

        /**
         * Module path
         *
         * @var string
         * @since 1.0.0
         */
        private static $module_path = __DIR__ . '/../../Modules';

        /**
         * Object constructor
         *
         * @param \Framework\ApplicationAbstract $app Application instance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public function __construct($app) {
            $this->app = $app;
        }

        /**
         * Get modules that run on this page
         *
         * @param array $request Request
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public function getUriLoads($request) {
            if ($this->running === null) {
                switch($this->app->db->getType()) {
                    case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    /* TODO: make join in order to see if they are active */
                    $sth = $this->app->db->con->prepare(
                        'SELECT
                        `' . $this->app->db->prefix . 'modules_load`.`type`, `' . $this->app->db->prefix . 'modules_load`.*
                        FROM
                        `' . $this->app->db->prefix . 'modules_load`
                        WHERE
                        `pid` IN(:pid1, :pid2, :pid3, :pid4)'
                        );

                    $uri_hash = $this->app->request->getHash();

                    $sth->bindValue(':pid1', $uri_hash[0], \PDO::PARAM_STR);
                    $sth->bindValue(':pid2', $uri_hash[1], \PDO::PARAM_STR);
                    $sth->bindValue(':pid3', $uri_hash[2], \PDO::PARAM_STR);
                    $sth->bindValue(':pid4', $uri_hash[3], \PDO::PARAM_STR);
                    $sth->execute();
                    $this->running = $sth->fetchAll(\PDO::FETCH_GROUP);
                    break;
                }
            }

            return $this->running;
        }

        /**
         * Get all installed modules
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public function getInstalledModules() {
            if ($this->installed === null) {
                switch($this->app->db->getType()) {
                    case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->app->db->con->prepare('SELECT `id`,`name`,`class`,`theme`,`version`,`id` FROM `' . $this->app->db->prefix . 'modules`');
                    $sth->execute();
                    $this->installed = $sth->fetchAll(\PDO::FETCH_GROUP);
                    break;
                }
            }

            return $this->installed;
        }

        /**
         * Get all installed modules that are active (not just on this uri)
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public function getActiveModules() {
            if ($this->active === null) {
                switch($this->app->db->getType()) {
                    case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->app->db->con->prepare('SELECT `id`,`name`,`class`,`theme`,`version`,`id` FROM `' . $this->app->db->prefix . 'modules` WHERE `active` = 1');
                    $sth->execute();
                    $this->active = $sth->fetchAll(\PDO::FETCH_GROUP);
                    break;
                }
            }

            return $this->active;
        }

        /**
         * Get all modules in the module directory
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public function getAllModules() {
            if($this->all === null) {
                chdir(self::$module_path);
                $files     = glob('*', GLOB_ONLYDIR);
                $c         = count($files);

                for ($i = 0; $i < $c; $i++) {
                    $path = self::$module_path . '/' . $files[$i] . '/info.json';

                    if (file_exists($path)) {
                        $json                                 = json_decode(file_get_contents($path), true);
                        $this->all[$json['name']['internal']] = $json;
                    }
                }
            }

            return $this->all;
        }

        /**
         * Get modules that are available from official resources
         *
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn
         */
        public function getAvailableModules() {

        }
    }
}
