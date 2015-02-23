<?php
namespace Modules\Reporter\Admin;
/**
 * Data evaluation install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Reporter
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Install
{
    /**
     * Install module
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool   Database pool instance
     * @param array                                    $info Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'reporter` (
                            `reporter_id` int(11) NOT NULL AUTO_INCREMENT,
                            `reporter_title` varchar(25) NOT NULL,
                            `reporter_desc` varchar(255) NOT NULL,
                            `reporter_media` int(11) NOT NULL,
                            `reporter_creator` int(11) NOT NULL,
                            `reporter_created` datetime NOT NULL,
                            PRIMARY KEY (`reporter_id`),
                            KEY `reporter_media` (`reporter_media`),
                            KEY `reporter_creator` (`reporter_creator`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();
                
                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'reporter`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'reporter_ibfk_1` FOREIGN KEY (`reporter_media`) REFERENCES `' . $dbPool->get('core')->prefix . 'media` (`media_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'reporter_ibfk_2` FOREIGN KEY (`reporter_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'reporter_permission` (
                            `reporter_permission_id` int(11) NOT NULL AUTO_INCREMENT,
                            `reporter_permission_type`  tinyint(1) NOT NULL,
                            `reporter_permission_reference` int(11) NOT NULL,
                            `reporter_permission_permission` tinyint(2) NOT NULL,
                            `reporter_permission_report` int(11) NOT NULL,
                            PRIMARY KEY (`reporter_permission_id`),
                            KEY `reporter_permission_report` (`reporter_permission_report`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'reporter_permission`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'reporter_permission_ibfk_1` FOREIGN KEY (`reporter_permission_report`) REFERENCES `' . $dbPool->get('core')->prefix . 'reporter` (`reporter_id`);'
                )->execute();
                break;
        }
        parent::installProviding($dbPool, __DIR__ . '/nav.install.json', 'Navigation');
    }
}
