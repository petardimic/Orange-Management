<?php
namespace Modules\Messages\Admin {
    /**
     * Navigation class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    Framework
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'messages` (
                            `MessageID` int(11) NOT NULL AUTO_INCREMENT,
                            `type`  tinyint(11) NOT NULL,
                            `person` int(11) DEFAULT NULL,
                            `email` varchar(256) NULL,
                            `sent` datetime NULL,
                            `cc` varchar(256) DEFAULT NULL,
                            `bcc` varchar(256) DEFAULT NULL,
                            `content` text DEFAULT NULL,
                            `reference` int(11) DEFAULT NULL,
                            PRIMARY KEY (`MessageID`),
                            KEY `person` (`person`),
                            KEY `reference` (`reference`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'messages`
                            ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`person`) REFERENCES `' . $db->prefix . 'accounts` (`id`),
                            ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`reference`) REFERENCES `' . $db->prefix . 'messages` (`MessageID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'messages_attachment` (
                            `MessageAttachmentID` int(11) NOT NULL AUTO_INCREMENT,
                            `media` int(11) DEFAULT NULL,
                            `email` int(11) NULL,
                            PRIMARY KEY (`MessageAttachmentID`),
                            KEY `media` (`media`),
                            KEY `email` (`email`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'messages_attachment`
                            ADD CONSTRAINT `messages_attachment_ibfk_1` FOREIGN KEY (`media`) REFERENCES `' . $db->prefix . 'media` (`MediaID`),
                            ADD CONSTRAINT `messages_attachment_ibfk_2` FOREIGN KEY (`email`) REFERENCES `' . $db->prefix . 'messages` (`MessageID`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}