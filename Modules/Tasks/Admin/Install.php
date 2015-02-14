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
class Install extends \phpOMS\Install\Module
{
    /**
     * Install module
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool   Database instance
     * @param array                                    $info Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->beginTransaction();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'task` (
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

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'task`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_ibfk_1` FOREIGN KEY (`task_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'task_element` (
                            `task_element_id` int(11) NOT NULL AUTO_INCREMENT,
                            `task_element_desc` text NOT NULL,
                            `task_element_plain` text NOT NULL,
                            `task_element_task` int(11) NOT NULL,
                            `task_element_creator` int(11) NOT NULL,
                            `task_element_status` tinyint(3) NOT NULL,
                            `task_element_due` datetime NOT NULL,
                            `task_element_forwarded` int(11) NOT NULL,
                            `task_element_created` datetime NOT NULL,
                            PRIMARY KEY (`task_element_id`),
                            KEY `task_element_task` (`task_element_task`),
                            KEY `task_element_creator` (`task_element_creator`),
                            KEY `task_element_forwarded` (`task_element_forwarded`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'task_element`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_element_ibfk_1` FOREIGN KEY (`task_element_task`) REFERENCES `' . $dbPool->get('core')->prefix . 'task` (`task_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_element_ibfk_2` FOREIGN KEY (`task_element_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_element_ibfk_3` FOREIGN KEY (`task_element_forwarded`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();
                
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'task_sub` (
                            `task_sub_id` int(11) NOT NULL AUTO_INCREMENT,
                            `task_sub_title` varchar(30) DEFAULT NULL,
                            `task_sub_desc` text NOT NULL,
                            `task_sub_plain` text NOT NULL,
                            `task_sub_status` tinyint(3) NOT NULL,
                            `task_sub_due` datetime NOT NULL,
                            `task_sub_done` datetime NOT NULL,
                            `task_sub_creator` int(11) NOT NULL,
                            `task_sub_created` datetime NOT NULL,
                            `task_sub_element` int(11) NOT NULL,
                            PRIMARY KEY (`task_sub_id`),
                            KEY `task_sub_creator` (`task_sub_creator`),
                            KEY `task_sub_element` (`task_sub_element`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'task_sub`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_sub_ibfk_1` FOREIGN KEY (`task_sub_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'task_sub_ibfk_2` FOREIGN KEY (`task_sub_element`) REFERENCES `' . $dbPool->get('core')->prefix . 'task_element` (`task_element_id`);'
                )->execute();

                $dbPool->get('core')->con->commit();
                break;
        }

        parent::installProviding($dbPool, __DIR__ . '/nav.install.json', 'Navigation');
    }
}
