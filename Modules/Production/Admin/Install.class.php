<?php
namespace Modules\Production\Admin {
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
            switch($db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'production_process` (
                            `ProcessID` int(11) NOT NULL AUTO_INCREMENT,
                            `product`  int(11) NOT NULL,
                            `status`  tinyint(2) NOT NULL,
                            `quantity` int(11) NOT NULL,
                            `for` int(11) NULL,
                            `orderer` int(11) NULL,
                            `ordered` datetime DEFAULT NULL,
                            `due` datetime DEFAULT NULL,
                            `planned` datetime DEFAULT NULL,
                            `started` datetime DEFAULT NULL,
                            `done` datetime DEFAULT NULL,
                            PRIMARY KEY (`ProcessID`),
                            KEY `product` (`product`),
                            KEY `for` (`for`),
                            KEY `orderer` (`orderer`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    /*$db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'production_process`
                            ADD CONSTRAINT `production_process_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `' . $db->prefix . 'accounts` (`id`);'
                    )->execute();*/

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'production_guideline` (
                            `ProductionGuidelineID` int(11) NOT NULL AUTO_INCREMENT,
                            `product` int(11) NOT NULL,
                            PRIMARY KEY (`ProductionGuidelineID`),
                            KEY `product` (`product`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'production_guideline_step` (
                            `ProductionStepID` int(11) NOT NULL AUTO_INCREMENT,
                            `guideline` int(11) NOT NULL,
                            `title` varchar(50) NOT NULL,
                            `text` text NOT NULL,
                            `order` tinyint(3) NOT NULL,
                            PRIMARY KEY (`ProductionStepID`),
                            KEY `guideline` (`guideline`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'production_guideline_step`
                            ADD CONSTRAINT `production_guideline_step_ibfk_1` FOREIGN KEY (`guideline`) REFERENCES `' . $db->prefix . 'production_guideline` (`ProductionGuidelineID`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}