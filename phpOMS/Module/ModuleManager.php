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
     * @var \phpOMS\DataStorage\Database\Pool
     * @since 1.0.0
     */
    private $dbPool = null;

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
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database pool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($dbPool)
    {
        $this->dbPool = $dbPool;
    }

    /**
     * Get modules that run on this page
     *
     * @param \phpOMS\Message\RequestAbstract $request Request
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function getUriLoads($request)
    {
        if($this->running === null) {
            switch($this->dbPool->get('core')->getType()) {
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
                    $sth = $this->dbPool->get('core')->con->prepare(
                        'SELECT
                        `' . $this->dbPool->get('core')->prefix . 'module_load`.`type`, `' . $this->dbPool->get('core')->prefix . 'module_load`.*
                        FROM
                        `' . $this->dbPool->get('core')->prefix . 'module_load`
                        WHERE
                        `pid` IN(' . $uri_pdo . ')'
                    );

                    $i = 1;
                    foreach($uri_hash as $hash) {
                        $sth->bindValue(':pid' . $i, $hash, \PDO::PARAM_STR);
                        $i++;
                    }

                    $sth->execute();
                    $this->running = $sth->fetchAll(\PDO::FETCH_GROUP);
                    break;
            }
        }

        return $this->running;
    }

    /**
     * Run all modules based on request
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function run()
    {
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
            switch($this->dbPool->get('core')->getType()) {
                case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->dbPool->get('core')->con->prepare('SELECT `id`,`name`,`class`,`theme`,`version`,`id` FROM `' . $this->dbPool->get('core')->prefix . 'module` WHERE `active` = 1');
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

            switch($this->dbPool->get('core')->getType()) {
                case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                    $this->dbPool->get('core')->con->beginTransaction();

                    // TODO: fix this!!! EASY!
                    $this->dbPool->get('core')->con->prepare(
                        'INSERT INTO `' . $this->dbPool->get('core')->prefix . 'module` (`id`, `name`, `theme`, `path`, `class`, `active`, `version`, `lang`, `js`, `css`) VALUES
                                (' . $info['name']['internal'] . ',  \'' . $info['name']['external'] . '\', \'' . $info['theme']['name'] . '\', \'' . $info['theme']['path'] . '\', \'' . $info['directory'] . '\', 1, \'' . $info['version'] . '\', ' . (int) $info['lang'] . ', ' . (int) $info['js'] . ', ' . (int) $info['css'] . ');'
                    )->execute();

                    foreach($info['load'] as $val) {
                        foreach($val['pid'] as $pid) {
                            $this->dbPool->get('core')->con->prepare(
                                'INSERT INTO `' . $this->dbPool->get('core')->prefix . 'module_load` (`pid`, `type`, `from`, `for`, `file`) VALUES
                                        (\'' . $pid . '\', ' . $val['type'] . ', ' . $val['from'] . ', ' . $val['for'] . ', \'' . $val['file'] . '\');'
                            )->execute();
                        }
                    }

                    $this->dbPool->get('core')->con->commit();

                    break;
            }

            foreach($info['dependencies'] as $key => $version) {
                $this->install($key);
            }

            $class = '\\Modules\\' . $module . '\\Admin\\Install';
            $class::install($this->dbPool, $info);

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
            switch($this->dbPool->get('core')->getType()) {
                case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->dbPool->get('core')->con->prepare('SELECT `id`,`name`,`class`,`theme`,`version`,`id` FROM `' . $this->dbPool->get('core')->prefix . 'module`');
                    $sth->execute();
                    $this->installed = $sth->fetchAll(\PDO::FETCH_GROUP);
                    break;
            }
        }

        return $this->installed;
    }

    public function installProviding($from, $for)
    {
        if(file_exists(self::MODULE_PATH . '/' . $from . '/Admin/Install/' . $for . '.php')) {
            $class = '\\Modules\\' . $from . '\\Admin\\Install\\' . $for;
            $class::install($this->dbPool, null);
        }
    }
}
