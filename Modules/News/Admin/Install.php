<?php
namespace Modules\News\Admin;

/**
 * News install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\News
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
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database instance
     * @param array                             $info   Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'news` (
                            `news_id` int(11) NOT NULL AUTO_INCREMENT,
                            `news_title` varchar(250) NOT NULL,
                            `news_featured` tinyint(1) DEFAULT NULL,
                            `news_content` text NOT NULL,
                            `news_plain` text NOT NULL,
                            `news_type` tinyint(2) NOT NULL,
                            `news_lang` tinyint(2) NOT NULL,
                            `news_publish` datetime NOT NULL,
                            `news_created` datetime NOT NULL,
                            `news_author` int(11) NOT NULL,
                            `news_last_changed` datetime NOT NULL,
                            `news_last_change` int(11) NOT NULL,
                            PRIMARY KEY (`news_id`),
                            KEY `news_author` (`news_author`),
                            KEY `news_last_change` (`news_last_change`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'news`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'news_ibfk_1` FOREIGN KEY (`news_author`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`),
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'news_ibfk_2` FOREIGN KEY (`news_last_change`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'news_tag` (
                            `news_tag_id` int(11) NOT NULL AUTO_INCREMENT,
                            `news_tag_news` int(11) NOT NULL,
                            `news_tag_tag` varchar(20) NOT NULL,
                            PRIMARY KEY (`news_tag_id`),
                            KEY `news_tag_news` (`news_tag_news`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'news_tag`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'news_tag_ibfk_1` FOREIGN KEY (`news_tag_news`) REFERENCES `' . $dbPool->get('core')->prefix . 'news` (`news_id`);'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'news_group` (
                            `news_group_id` int(11) NOT NULL AUTO_INCREMENT,
                            `news_group_news` int(11) NOT NULL,
                            `news_group_group` int(11) NOT NULL,
                            PRIMARY KEY (`news_group_id`),
                            KEY `news_group_news` (`news_group_news`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'news_group`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'news_group_ibfk_1` FOREIGN KEY (`news_group_news`) REFERENCES `' . $dbPool->get('core')->prefix . 'news` (`news_id`);'
                )->execute();
                break;
        }
    }
}