<?php
namespace Modules\Tasks\Admin {
    /**
     * Navigation class
     *
     * PHP Version 5.4
     *
     * @category   Module
     * @package    Tasks
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Install extends \Framework\Install\Module {
        /**
         * Install module
         *
         * @param \Framework\DataStorage\Database\Database $db   Database instance
         * @param array                                    $info Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function install(&$db, $info) {
            switch($db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $db->con->beginTransaction();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'tasks` (
                            `TaskID` int(11) NOT NULL AUTO_INCREMENT,
                            `title` varchar(30) DEFAULT NULL,
                            `desc` text NOT NULL,
                            `plain` text NOT NULL,
                            `status` tinyint(3) NOT NULL,
                            `due` datetime NOT NULL,
                            `done` datetime NOT NULL,
                            `creator` int(11) NOT NULL,
                            `created` datetime NOT NULL,
                            PRIMARY KEY (`TaskID`),
                            KEY `creator` (`creator`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'tasks`
                            ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'tasks_element` (
                            `TaskelementID` int(11) NOT NULL AUTO_INCREMENT,
                            `desc` text NOT NULL,
                            `plain` text NOT NULL,
                            `task` int(11) NOT NULL,
                            `creator` int(11) NOT NULL,
                            `status` tinyint(3) NOT NULL,
                            `due` datetime NOT NULL,
                            `forwarded` int(11) NOT NULL,
                            `created` datetime NOT NULL,
                            PRIMARY KEY (`TaskelementID`),
                            KEY `task` (`task`),
                            KEY `creator` (`creator`),
                            KEY `forwarded` (`forwarded`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'tasks_element`
                            ADD CONSTRAINT `tasks_element_ibfk_1` FOREIGN KEY (`task`) REFERENCES `' . $db->prefix . 'tasks` (`TaskID`),
                            ADD CONSTRAINT `tasks_element_ibfk_2` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'accounts` (`id`),
                            ADD CONSTRAINT `tasks_element_ibfk_3` FOREIGN KEY (`forwarded`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->commit();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}