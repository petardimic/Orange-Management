<?php
namespace Modules\Media\Admin {
    /**
     * Install class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Media
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
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'media` (
                            `MediaID` int(11) NOT NULL AUTO_INCREMENT,
                            `name`  varchar(100) NOT NULL,
                            `file` varchar(255) NOT NULL,
                            `type` varchar(10) NULL,
                            `size` int(11) NULL,
                            `creator` int(11) DEFAULT NULL,
                            `created` datetime DEFAULT NULL,
                            PRIMARY KEY (`MediaID`),
                            KEY `creator` (`creator`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'media`
                            ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'media_permission` (
                            `MediaPermissionID` int(11) NOT NULL AUTO_INCREMENT,
                            `type`  tinyint(1) NOT NULL,
                            `reference` int(11) NOT NULL,
                            `permission` tinyint(2) NOT NULL,
                            `media` int(11) NOT NULL,
                            PRIMARY KEY (`MediaPermissionID`),
                            KEY `media` (`media`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'media_permission`
                            ADD CONSTRAINT `media_permission_ibfk_1` FOREIGN KEY (`media`) REFERENCES `' . $db->prefix . 'media` (`MediaID`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}