<?php
namespace Modules\Messages\Admin;

/**
 * Messages install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Messages
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
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'message` (
                            `message_id` int(11) NOT NULL AUTO_INCREMENT,
                            `message_type`  tinyint(11) NOT NULL,
                            `message_account` int(11) DEFAULT NULL,
                            `message_email` varchar(256) NULL,
                            `message_sent` datetime NULL,
                            `message_cc` varchar(256) DEFAULT NULL,
                            `message_bcc` varchar(256) DEFAULT NULL,
                            `message_content` text DEFAULT NULL,
                            `message_reference` int(11) DEFAULT NULL,
                            PRIMARY KEY (`message_id`),
                            KEY `message_account` (`message_account`),
                            KEY `message_reference` (`message_reference`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'message`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'message_ibfk_1` FOREIGN KEY (`message_account`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'message_ibfk_2` FOREIGN KEY (`message_reference`) REFERENCES `' . $dbPool->get('core')->prefix . 'message` (`message_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'messages_attachment` (
                            `messages_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
                            `messages_attachment_media` int(11) DEFAULT NULL,
                            `messages_attachment_message` int(11) NULL,
                            PRIMARY KEY (`messages_attachment_id`),
                            KEY `messages_attachment_media` (`messages_attachment_media`),
                            KEY `messages_attachment_message` (`messages_attachment_message`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'messages_attachment`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'messages_attachment_ibfk_1` FOREIGN KEY (`messages_attachment_media`) REFERENCES `' . $dbPool->get('core')->prefix . 'media` (`media_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'messages_attachment_ibfk_2` FOREIGN KEY (`messages_attachment_message`) REFERENCES `' . $dbPool->get('core')->prefix . 'message` (`message_id`);'
                )->execute();
                break;
        }

        parent::installProviding($dbPool, __DIR__ . '/nav.install.json', 'Navigation');
    }
}