<?php
namespace Framework\Module {
    /**
     * Module abstraction class
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
    abstract class ModuleAbstract {
        /**
         * Database
         *
         * @var \Framework\DataStorage\Database\Database
         * @since 1.0.0
         */
        protected $db = null;

        /**
         * Dependencies
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $dependencies = null;

        /**
         * Receiving
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $receiving = null;

        /**
         * Providing
         *
         * @var int[]
         * @since 1.0.0
         */
        public static $providing = null;

        /**
         * Theme path
         *
         * @var string
         * @since 1.0.0
         */
        public $theme_path = '';

        /**
         * User object
         *
         * @var \Framework\DataStorage\Database\Objects\User\User
         * @since 1.0.0
         */
        protected $user = null;

        /**
         * Database
         *
         * @var \Framework\DataStorage\Cache\Cache
         * @since 1.0.0
         */
        protected $cache = null;

        /**
         * Request instance
         *
         * @var \Framework\Request\Request
         * @since 1.0.0
         */
        public $request = null;

        /**
         * Module info
         *
         * @var array
         * @since 1.0.0
         */
        public static $css = false;

        /**
         * Constructor
         *
         * @param string $theme_path
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        protected function initialize($theme_path) {
            $this->theme_path = $theme_path;

            /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
            $this->db = \Framework\DataStorage\Database\Database::getInstance();
            /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
            $this->user = \Framework\DataStorage\Database\Objects\User\User::getInstance(-1);
            /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
            $this->cache = \Framework\DataStorage\Cache\Cache::getInstance();
            /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
            $this->request = \Framework\Request\Request::getInstance();

            static::$dependencies;
            static::$receiving;
            static::$providing;
            static::$css;
        }

        /**
         * Shows module content
         *
         * @para   array $data
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show($data = null) {
        }

        /**
         * Shows module content provided by other modules
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        protected function show_push() {
            if (isset(self::$receiving)) {
                foreach (self::$receiving as $mid) {
                    /** @noinspection PhpUndefinedMethodInspection */
                    \Framework\Module\ModuleFactory::$initialized[$mid]->show_content_push();
                }
            }
        }

        /**
         * Shows module content provided by other modules
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function show_content_push() {
        }

        /**
         * Install module
         *
         * @param \Framework\DataStorage\Database\Database $db     Database instance
         * @param int                      $module Module ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install(&$db, $module) {
            if (file_exists(__DIR__ . '/../../Modules/' . $module . '/' . 'info.json')) {
                $info = json_decode(file_get_contents(__DIR__ . '/../../Modules/' . $module . '/' . 'info.json'), true);

                switch ($db->type) {
                    case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                        $db->con->beginTransaction();

                        $db->con->prepare(
                            'INSERT INTO `' . $db->prefix . 'modules` (`id`, `name`, `theme`, `path`, `class`, `active`, `version`, `lang`, `js`, `css`) VALUES
				            (' . $info['name']['internal'] . ',  \'' . $info['name']['external'] . '\', \'' . $info['theme']['name'] . '\', \'' . $info['theme']['path'] . '\', \'' . $info['class'] . '\', 1, \'' . $info['version'] . '\', ' . (int)$info['lang'] . ', ' . (int)$info['js'] . ', ' . (int)$info['css'] . ');'
                        )->execute();

                        foreach ($info['load'] as $val) {
                            foreach ($val['pid'] as $pid) {
                                $db->con->prepare(
                                    'INSERT INTO `' . $db->prefix . 'modules_load` (`pid`, `type`, `from`, `for`, `file`) VALUES
				                        (\'' . $pid . '\', ' . $val['type'] . ', ' . $val['from'] . ', ' . $val['for'] . ', \'' . $val['file'] . '\');'
                                )->execute();
                            }
                        }

                        $db->con->commit();

                        break;
                }

                /** @noinspection PhpIncludeInspection */
                require_once __DIR__ . '/../../Modules/' . $module . '/' . $info['class'] . '.class.php';
                $class = '\\Modules\\' . $module . '\\' . $info['class'];

                /**
                 * @var \Framework\Module\ModuleAbstract $class
                 */
                $class::install($db, $info);
            }
        }

        /**
         * Install data from providing modules
         *
         * @param \Framework\DataStorage\Database\Database $db   Database instance
         * @param array              $path Install file path
         * @param int                $id   ID of the receiving module
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install_providing(&$db, $path, $id) {
            $install = json_decode(file_get_contents($path), true);
            $json    = json_decode(file_get_contents(__DIR__ . '/../../Modules/' . $id . '/info.json'), true);

            /** @noinspection PhpIncludeInspection */
            require_once __DIR__ . '/../../Modules/' . $id . '/' . $json['class'] . '.class.php';
            $class = '\\Modules\\' . $id . '\\' . $json['class'];

            /**
             * @var \Framework\Module\ModuleAbstract $class
             */
            $class::install_external($db, $install);
        }

        /**
         * Install data from providing modules
         *
         * @param \Framework\DataStorage\Database\Database $db   Database instance
         * @param array              $data Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install_external(&$db, $data) {
        }

        /**
         * Uninstall module
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function uninstall() {
        }

        /**
         * Activate module
         *
         * @param \Framework\DataStorage\Database\Database $db Database instance
         * @param int                $id Module ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function activate(&$db, $id) {
            switch ($db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $db->con->query(
                        'UPDATE `' . $db->prefix . 'modules` SET `active` = 1 WHERE `id` = ' . $id . ';'
                    );
                    break;
            }
        }

        /**
         * Deactivate module
         *
         * @param \Framework\DataStorage\Database\Database $db Database instance
         * @param int                $id Module ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function deactivate(&$db, $id) {
            switch ($db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $db->con->query(
                        'UPDATE `' . $db->prefix . 'modules` SET `active` = 0 WHERE `id` = ' . $id . ';'
                    );
                    break;
            }
        }

        /**
         * Delete account
         *
         * This function gets called when a account gets deleted
         *
         * @param int $id Account ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function delete_account($id) {
        }

        /**
         * Delete module
         *
         * This function gets called when a module gets deleted
         *
         * @param int $id Module ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function delete_module($id) {
        }
    }
}