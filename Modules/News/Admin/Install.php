<?php
namespace Modules\News\Admin {
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'news` (
                            `NewsID` int(11) NOT NULL AUTO_INCREMENT,
                            `title` varchar(250) NOT NULL,
                            `featured` tinyint(1) DEFAULT NULL,
                            `content` text NOT NULL,
                            `plain` text NOT NULL,
                            `type` tinyint(2) NOT NULL,
                            `lang` tinyint(2) NOT NULL,
                            `publish` datetime NOT NULL,
                            `created` datetime NOT NULL,
                            `author` int(11) NOT NULL,
                            `last_changed` datetime NOT NULL,
                            `last_change` int(11) NOT NULL,
                            PRIMARY KEY (`NewsID`),
                            KEY `author` (`author`),
                            KEY `last_change` (`last_change`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'news`
                            ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author`) REFERENCES `' . $db->prefix . 'accounts` (`id`),
                            ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`last_change`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'news_tag` (
                            `NewsTagID` int(11) NOT NULL AUTO_INCREMENT,
                            `news` int(11) NOT NULL,
                            `tag` varchar(20) NOT NULL,
                            PRIMARY KEY (`NewsTagID`),
                            KEY `news` (`news`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'news_tag`
                            ADD CONSTRAINT `news_tag_ibfk_1` FOREIGN KEY (`news`) REFERENCES `' . $db->prefix . 'news` (`NewsID`);'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'news_group` (
                            `NewsGroupID` int(11) NOT NULL AUTO_INCREMENT,
                            `news` int(11) NOT NULL,
                            `group` int(11) NOT NULL,
                            PRIMARY KEY (`NewsGroupID`),
                            KEY `news` (`news`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'news_group`
                            ADD CONSTRAINT `news_group_ibfk_1` FOREIGN KEY (`news`) REFERENCES `' . $db->prefix . 'news` (`NewsID`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}