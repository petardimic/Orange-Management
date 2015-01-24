<?php
namespace Modules\ItemReference\Admin {
    /**
     * Navigation class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Modules\ItemReference
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
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'itemreference` (
                            `ItemReferenceId` int(11) NOT NULL AUTO_INCREMENT,
                            `ItemRefer` varchar(30) DEFAULT NULL,
                            `parent` int(11) DEFAULT NULL,
                            `unit` int(11) NOT NULL,
                            PRIMARY KEY (`BusinessDepartmentID`),
                            KEY `parent` (`parent`),
                            KEY `unit` (`unit`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();

                    $db->con->prepare(
                        'ALTER TABLE `' . $db->prefix . 'business_department`
                            ADD CONSTRAINT `business_department_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `' . $db->prefix . 'business_department` (`BusinessDepartmentID`),
                            ADD CONSTRAINT `business_department_ibfk_2` FOREIGN KEY (`unit`) REFERENCES `' . $db->prefix . 'business_unit` (`BusinessUnitID`);'
                    )->execute();
                    break;
            }

            parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }
}