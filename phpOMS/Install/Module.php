<?php
namespace phpOMS\Install;

/**
 * Module install abstraction class
 *
 * The default installation procedure for all modules.
 * In fact many modules can rely on these methods in order to minimize their installation abstraction.
 *
 * PHP Version 5.4
 *
 * @category   Install
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class Module
{
    /**
     * Install module
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database instance
     * @param int                               $module Module ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $module)
    {
        if(file_exists(__DIR__ . '/../../Modules/' . $module . '/' . 'info.json')) {
            $info = json_decode(file_get_contents(__DIR__ . '/../../Modules/' . $module . '/' . 'info.json'), true);

            switch($dbPool->get('core')->getType()) {
                case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                    $dbPool->get('core')->con->beginTransaction();

                    $dbPool->get('core')->con->prepare(
                        'INSERT INTO `' . $dbPool->get('core')->prefix . 'module` (`id`, `name`, `theme`, `path`, `class`, `active`, `version`, `lang`, `js`, `css`) VALUES
                                (' . $info['name']['internal'] . ',  \'' . $info['name']['external'] . '\', \'' . $info['theme']['name'] . '\', \'' . $info['theme']['path'] . '\', \'' . $info['class'] . '\', 1, \'' . $info['version'] . '\', ' . (int) $info['lang'] . ', ' . (int) $info['js'] . ', ' . (int) $info['css'] . ');'
                    )->execute();

                    foreach($info['load'] as $val) {
                        foreach($val['pid'] as $pid) {
                            $dbPool->get('core')->con->prepare(
                                'INSERT INTO `' . $dbPool->get('core')->prefix . 'module_load` (`pid`, `type`, `from`, `for`, `file`) VALUES
                                        (\'' . $pid . '\', ' . $val['type'] . ', ' . $val['from'] . ', ' . $val['for'] . ', \'' . $val['file'] . '\');'
                            )->execute();
                        }
                    }

                    $dbPool->get('core')->con->commit();

                    break;
            }

            $class = '\\Modules\\' . $module . '\\Admin\\Install';

            /**
             * @var \phpOMS\Install\Module $class
             */
            $class::install($dbPool, $info);
        }
    }

    /**
     * Install data from providing modules
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database instance
     * @param array                             $path   Install file path
     * @param int                               $id     ID of the receiving module
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function installProviding($dbPool, $path, $id)
    {
        if(file_exists(__DIR__ . '/../../Modules/' . $id . '/Admin/Install.php')) {
            $install = json_decode(file_get_contents($path), true);
            // TODO: maybe remove? $json    = json_decode(file_get_contents(__DIR__ . '/../../Modules/' . $id . '/info.json'), true);

            $class = '\\Modules\\' . $id . '\\Admin\\Install';

            /**
             * @var \phpOMS\Module\ModuleAbstract $class
             */
            $class::installExternal($dbPool, $install);
        }
    }

    /**
     * Install data from providing modules
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database instance
     * @param array                             $data   Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function installExternal($dbPool, $data)
    {
    }

    /**
     * Uninstall module
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function uninstall()
    {
    }

    /**
     * Activate module
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database instance
     * @param int                               $id     Module ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function activate($dbPool, $id)
    {
        switch($dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->query(
                    'UPDATE `' . $dbPool->get('core')->prefix . 'module` SET `active` = 1 WHERE `id` = ' . $id . ';'
                );
                break;
        }
    }

    /**
     * Deactivate module
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database instance
     * @param int                               $id     Module ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function deactivate($dbPool, $id)
    {
        switch($dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->query(
                    'UPDATE `' . $dbPool->get('core')->prefix . 'module` SET `active` = 0 WHERE `id` = ' . $id . ';'
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
    public static function deleteAccount($id)
    {
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
    public static function deleteModule($id)
    {
    }
}