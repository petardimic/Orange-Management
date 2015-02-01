<?php
namespace Modules\Media\Admin;

/**
 * Media install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Media
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
     * @param \Framework\DataStorage\Database\Pool $dbPool   Database instance
     * @param array                                    $info Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'media` (
                            `media_id` int(11) NOT NULL AUTO_INCREMENT,
                            `media_name`  varchar(100) NOT NULL,
                            `media_file` varchar(255) NOT NULL,
                            `media_type` varchar(10) NULL,
                            `media_size` int(11) NULL,
                            `media_creator` int(11) DEFAULT NULL,
                            `media_created` datetime DEFAULT NULL,
                            PRIMARY KEY (`media_id`),
                            KEY `media_creator` (`media_creator`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'media`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'media_ibfk_1` FOREIGN KEY (`media_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'media_permission` (
                            `media_permission_id` int(11) NOT NULL AUTO_INCREMENT,
                            `media_permission_type`  tinyint(1) NOT NULL,
                            `media_permission_reference` int(11) NOT NULL,
                            `media_permission_permission` tinyint(2) NOT NULL,
                            `media_permission_media` int(11) NOT NULL,
                            PRIMARY KEY (`media_permission_id`),
                            KEY `media_permission_media` (`media_permission_media`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'media_permission`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'media_permission_ibfk_1` FOREIGN KEY (`media_permission_media`) REFERENCES `' . $dbPool->get('core')->prefix . 'media` (`media_id`);'
                )->execute();
                break;
        }

        parent::installProviding($dbPool, __DIR__ . '/nav.install.json', 'Navigation');
    }
}