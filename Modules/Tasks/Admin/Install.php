<?php
namespace Modules\Tasks\Admin;

/**
 * Tasks install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Tasks
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Install extends \Framework\Install\Module
{
    /**
     * Install module
     *
     * @param \Framework\DataStorage\Database\Database $db   Database instance
     * @param array                                    $info Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install(&$db, $info)
    {
        switch($db->getType()) {
            case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                $db->con->beginTransaction();

                $db->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'task` (
                            `task_id` int(11) NOT NULL AUTO_INCREMENT,
                            `task_title` varchar(30) DEFAULT NULL,
                            `task_desc` text NOT NULL,
                            `task_plain` text NOT NULL,
                            `task_status` tinyint(3) NOT NULL,
                            `task_due` datetime NOT NULL,
                            `task_done` datetime NOT NULL,
                            `task_creator` int(11) NOT NULL,
                            `task_created` datetime NOT NULL,
                            PRIMARY KEY (`task_id`),
                            KEY `task_creator` (`task_creator`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $db->con->prepare(
                    'ALTER TABLE `' . $db->prefix . 'task`
                            ADD CONSTRAINT `' . $db->prefix . 'task_ibfk_1` FOREIGN KEY (`task_creator`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                )->execute();

                $db->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'tasks_element` (
                            `tasks_element_id` int(11) NOT NULL AUTO_INCREMENT,
                            `tasks_element_desc` text NOT NULL,
                            `tasks_element_plain` text NOT NULL,
                            `tasks_element_task` int(11) NOT NULL,
                            `tasks_element_creator` int(11) NOT NULL,
                            `tasks_element_status` tinyint(3) NOT NULL,
                            `tasks_element_due` datetime NOT NULL,
                            `tasks_element_forwarded` int(11) NOT NULL,
                            `tasks_element_created` datetime NOT NULL,
                            PRIMARY KEY (`tasks_element_id`),
                            KEY `tasks_element_task` (`tasks_element_task`),
                            KEY `tasks_element_creator` (`tasks_element_creator`),
                            KEY `tasks_element_forwarded` (`tasks_element_forwarded`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $db->con->prepare(
                    'ALTER TABLE `' . $db->prefix . 'tasks_element`
                            ADD CONSTRAINT `' . $db->prefix . 'task_element_ibfk_1` FOREIGN KEY (`tasks_element_task`) REFERENCES `' . $db->prefix . 'task` (`task_id`),
                            ADD CONSTRAINT `' . $db->prefix . 'task_element_ibfk_2` FOREIGN KEY (`tasks_element_creator`) REFERENCES `' . $db->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $db->prefix . 'task_element_ibfk_3` FOREIGN KEY (`tasks_element_forwarded`) REFERENCES `' . $db->prefix . 'account` (`account_id`);'
                )->execute();

                $db->con->commit();
                break;
        }

        parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
    }
}