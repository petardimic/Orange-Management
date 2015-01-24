<?php
namespace Modules\Clocking\Admin;

/**
 * Human resources employee clocking install class
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
                    'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'clocking` (
                            `clocking_id` int(11) NOT NULL AUTO_INCREMENT,
                            `clocking_employee` int(11) DEFAULT NULL,
                            `clocking_start` datetime DEFAULT NULL,
                            `clocking_end` datetime DEFAULT NULL,
                            `clocking_type` tinyint(1) NOT NULL,
                            PRIMARY KEY (`clocking_id`),
                            KEY `clocking_employee` (`clocking_employee`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $db->con->prepare(
                    'ALTER TABLE `' . $db->prefix . 'clocking`
                            ADD CONSTRAINT `' . $db->prefix . 'clocking_ibfk_1` FOREIGN KEY (`clocking_employee`) REFERENCES `' . $db->prefix . 'hr_staff` (`hr_staff_id`);'
                )->execute();
                break;
        }

        parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
    }
}