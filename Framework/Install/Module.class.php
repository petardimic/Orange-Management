<?php
namespace Framework\Install {
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
    abstract class Module {
        /**
         * Install module
         *
         * @param \Framework\DataStorage\Database\Database $db     Database instance
         * @param int                                      $module Module ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install(&$db, $module) {
            if (file_exists(__DIR__ . '/../../Modules/' . $module . '/' . 'info.json')) {
                $info = json_decode(file_get_contents(__DIR__ . '/../../Modules/' . $module . '/' . 'info.json'), true);

                switch ($db->getType()) {
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

                $class = '\\Modules\\' . $module . '\\Admin\\Install';

                /**
                 * @var \Framework\Install\Module $class
                 */
                $class::install($db, $info);
            }
        }

        /**
         * Install data from providing modules
         *
         * @param \Framework\DataStorage\Database\Database $db   Database instance
         * @param array                                    $path Install file path
         * @param int                                      $id   ID of the receiving module
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install_providing(&$db, $path, $id) {
            $install = json_decode(file_get_contents($path), true);
            $json    = json_decode(file_get_contents(__DIR__ . '/../../Modules/' . $id . '/info.json'), true);

            $class = '\\Modules\\' . $id . '\\Admin\\Install';

            /**
             * @var \Framework\Module\ModuleAbstract $class
             */
            $class::install_external($db, $install);
        }

        /**
         * Install data from providing modules
         *
         * @param \Framework\DataStorage\Database\Database $db   Database instance
         * @param array                                    $data Module info
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
         * @param int                                      $id Module ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function activate(&$db, $id) {
            switch ($db->getType()) {
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
         * @param int                                      $id Module ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function deactivate(&$db, $id) {
            switch ($db->getType()) {
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