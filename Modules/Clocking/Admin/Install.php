<?php
namespace Modules\Clocking\Admin;

/**
 * Human resources employee clocking install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Clocking
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
     * @param \Framework\DataStorage\Database\Pool $dbPool   Database instance
     * @param array                                    $info Module info
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function install($dbPool, $info)
    {
        switch($dbPool->get('core')->getType()) {
            case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                $dbPool->get('core')->con->prepare(
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'clocking` (
                            `clocking_id` int(11) NOT NULL AUTO_INCREMENT,
                            `clocking_employee` int(11) DEFAULT NULL,
                            `clocking_start` datetime DEFAULT NULL,
                            `clocking_end` datetime DEFAULT NULL,
                            `clocking_type` tinyint(1) NOT NULL,
                            PRIMARY KEY (`clocking_id`),
                            KEY `clocking_employee` (`clocking_employee`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();

                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'clocking`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'clocking_ibfk_1` FOREIGN KEY (`clocking_employee`) REFERENCES `' . $dbPool->get('core')->prefix . 'hr_staff` (`hr_staff_id`);'
                )->execute();
                break;
        }

        parent::installProviding($dbPool, __DIR__ . '/nav.install.json', 'Navigation');
    }
}