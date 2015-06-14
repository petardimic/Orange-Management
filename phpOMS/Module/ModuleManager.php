<?php
namespace phpOMS\Module;

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
class ModuleManager
{

    /**
     * Module path
     *
     * @var string
     * @since 1.0.0
     */
    const MODULE_PATH = __DIR__ . '/../../Modules';

// region Class Fields
    /**
     * All modules that are running on this uri
     *
     * @var \phpOMS\Module\ModuleAbstract
     * @since 1.0.0
     */
    public $running = null;

    /**
     * FileCache instance
     *
     * @var \phpOMS\ApplicationAbstract
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

// endregion

    /**
     * Constructor
     *
     * @param \phpOMS\ApplicationAbstract $app Application
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get modules that run on this page
     *
     * @param \phpOMS\Message\Http\Request $request Request
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function getRoutedModules($request)
    {
        switch($this->app->dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $uri_hash = $request->getHash();
                $uri_pdo  = '';

                $i = 1;
                foreach($uri_hash as $hash) {
                    $uri_pdo .= ':pid' . $i . ',';
                    $i++;
                }

                $uri_pdo = rtrim($uri_pdo, ',');

                /* TODO: make join in order to see if they are active */
                $sth = $this->app->dbPool->get('core')->con->prepare(
                    'SELECT
                        `' . $this->app->dbPool->get('core')->prefix . 'module_load`.`module_load_type`, `' . $this->app->dbPool->get('core')->prefix . 'module_load`.*
                        FROM
                        `' . $this->app->dbPool->get('core')->prefix . 'module_load`
                        WHERE
                        `module_load_pid` IN(' . $uri_pdo . ')'
                );

                $i = 1;
                foreach($uri_hash as $hash) {
                    $sth->bindValue(':pid' . $i, $hash, \PDO::PARAM_STR);
                    $i++;
                }

                $sth->execute();

                return $sth->fetchAll(\PDO::FETCH_GROUP);
        }

        return null;
    }

    /**
     * Get all installed modules that are active (not just on this uri)
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function getActiveModules()
    {
        if($this->active === null) {
            switch($this->app->dbPool->get('core')->getType()) {
                case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->app->dbPool->get('core')->con->prepare('SELECT `module_id`,`module_name`,`module_path`,`module_theme`,`module_version`,`module_id` FROM `' . $this->app->dbPool->get('core')->prefix . 'module` WHERE `module_active` = 1');
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
    public function getAllModules()
    {
        if($this->all === null) {
            chdir(self::MODULE_PATH);
            $files = glob('*', GLOB_ONLYDIR);
            $c     = count($files);

            for($i = 0; $i < $c; $i++) {
                $path = self::MODULE_PATH . '/' . $files[$i] . '/info.json';

                if(file_exists($path)) {
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
    public function getAvailableModules()
    {
    }

    /**
     * Install module
     *
     * @param string $module Module name
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function install($module)
    {
        $installed = $this->getInstalledModules();

        if(isset($installed[$module])) {
            return;
        }

        if(!file_exists(self::MODULE_PATH . '/' . $module . '/Admin/Install.php')) {
            // todo download;
        }

        if(file_exists(self::MODULE_PATH . '/' . $module . '/' . 'info.json')) {
            $info = json_decode(file_get_contents(self::MODULE_PATH . '/' . $module . '/' . 'info.json'), true);

            switch($this->app->dbPool->get('core')->getType()) {
                case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                    $this->app->dbPool->get('core')->con->beginTransaction();

                    $sth = $this->app->dbPool->get('core')->con->prepare(
                        'INSERT INTO `' . $this->app->dbPool->get('core')->prefix . 'module` (`module_id`, `module_name`, `module_theme`, `module_path`, `module_active`, `module_version`) VALUES
                                (:internal,  :external, :theme, :path, :active, :version);'
                    );

                    $sth->bindValue(':internal', $info['name']['internal'], \PDO::PARAM_INT);
                    $sth->bindValue(':external', $info['name']['external'], \PDO::PARAM_STR);
                    $sth->bindValue(':theme', 'Default', \PDO::PARAM_STR);
                    $sth->bindValue(':path', $info['directory'], \PDO::PARAM_STR);
                    $sth->bindValue(':active', 1, \PDO::PARAM_INT);
                    $sth->bindValue(':version', $info['version'], \PDO::PARAM_STR);

                    $sth->execute();

                    $sth = $this->app->dbPool->get('core')->con->prepare(
                        'INSERT INTO `' . $this->app->dbPool->get('core')->prefix . 'module_load` (`module_load_pid`, `module_load_type`, `module_load_from`, `module_load_for`, `module_load_file`) VALUES
                                        (:pid, :type, :from, :for, :file);'
                    );

                    foreach($info['load'] as $val) {
                        foreach($val['pid'] as $pid) {
                            $sth->bindValue(':pid', $pid, \PDO::PARAM_STR);
                            $sth->bindValue(':type', $val['type'], \PDO::PARAM_INT);
                            $sth->bindValue(':from', $val['from'], \PDO::PARAM_INT);
                            $sth->bindValue(':for', $val['for'], \PDO::PARAM_INT);
                            $sth->bindValue(':file', $val['file'], \PDO::PARAM_STR);

                            $sth->execute();
                        }
                    }

                    $this->app->dbPool->get('core')->con->commit();

                    break;
            }

            foreach($info['dependencies'] as $key => $version) {
                $this->install($key);
            }

            $class = '\\Modules\\' . $module . '\\Admin\\Install';
            $class::install($this->app->dbPool, $info);

            // TODO: change this
            $this->installed[$module] = true;

            foreach($info['providing'] as $key => $version) {
                $this->installProviding($module, $key);
            }

            /* Install receiving */
            foreach($installed as $key => $value) {
                $this->installProviding($key, $module);
            }
        }
    }

    /**
     * Initialize module
     *
     * @param string $module Module name
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function initModule($module)
    {
        if(is_array($module)) {
            foreach($module as $m) {
                $this->running[$m] = \phpOMS\Module\ModuleFactory::getInstance($m, $this->app);
            }
        } else {
            $this->running[$module] = \phpOMS\Module\ModuleFactory::getInstance($module, $this->app);
        }
    }

    /**
     * Get module instance
     *
     * @param string $module Module name
     *
     * @return \phpOMS\Module\ModuleAbstract
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function get($module)
    {
        return isset($this->running[$module]) ? $this->running[$module] : null;
    }

    /**
     * Load module language
     *
     * @param string $language    Langauge
     * @param string $destination Destination
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function loadLanguage($language, $destination)
    {
        foreach($this->running as $name => $m) {
            $this->app->l11nManager->loadLanguage($m->getLocalization($destination), $name, $m->getLanguage($language, $destination));
        }
    }

    /**
     * Get all installed modules
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function getInstalledModules()
    {
        if($this->installed === null) {
            switch($this->app->dbPool->get('core')->getType()) {
                case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->app->dbPool->get('core')->con->prepare('SELECT `module_id`,`module_name`,`module_theme`,`module_version`,`module_id` FROM `' . $this->app->dbPool->get('core')->prefix . 'module`');
                    $sth->execute();
                    $this->installed = $sth->fetchAll(\PDO::FETCH_GROUP);
                    break;
            }
        }

        return $this->installed;
    }

    /**
     * Install providing
     *
     * Installing additional functionality for another module
     *
     * @param string $from From module
     * @param string $for  For module
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function installProviding($from, $for)
    {
        if(file_exists(self::MODULE_PATH . '/' . $from . '/Admin/Install/' . $for . '.php')) {
            $class = '\\Modules\\' . $from . '\\Admin\\Install\\' . $for;
            $class::install($this->app->dbPool, null);
        }
    }
}
