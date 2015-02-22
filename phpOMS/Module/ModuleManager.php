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

    /**
     * All modules that are running on this uri
     *
     * @var \phpOMS\Module\ModuleAbstract
     * @since 1.0.0
     */
    public $running = null;

    /**
     * Module path
     *
     * @var string
     * @since 1.0.0
     */
    const MODULE_PATH = __DIR__ . '/../../Modules';

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
                    /* TODO: make join in order to see if they are active */
                    $sth = $this->dbPool->get('core')->con->prepare(
                        'SELECT
                        `' . $this->dbPool->get('core')->prefix . 'module_load`.`type`, `' . $this->dbPool->get('core')->prefix . 'module_load`.*
                        FROM
                        `' . $this->dbPool->get('core')->prefix . 'module_load`
                        WHERE
                        `pid` IN(:pid1, :pid2, :pid3, :pid4)'
                    );

                    /** @noinspection PhpUndefinedMethodInspection */
                    $uri_hash = $request->getHash();

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

    public function install($module) {
        $installed = $this->getInstalledModules();

        if(!file_exists(__DIR__ . '/../../Modules/'.$module.'/Admin/Install.php')) {
            // todo download;
        }


    }
}
