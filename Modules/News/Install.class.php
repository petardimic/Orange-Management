<?php
namespace Modules\News {
    /**
     * Navigation class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
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
            switch ($db->type) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'news` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `title` varchar(250) NOT NULL,
                            `featured` tinyint(1) DEFAULT NULL,
                            `content` text NOT NULL,
                            `type` tinyint(2) NOT NULL,
                            `lang` tinyint(2) NOT NULL,
                            `created` datetime NOT NULL,
                            `author` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `author` (`author`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'news`
                            ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();

                    break;
            }
        }
    }
}