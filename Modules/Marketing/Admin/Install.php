<?php
namespace Modules\Marketing\Admin;

/**
 * Marketing install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Marketing
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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'marketing_promotion` (
                            `marketing_promotion_id` int(11) NOT NULL AUTO_INCREMENT,
                            `marketing_promotion_name`  varchar(30) NOT NULL,
                            `marketing_promotion_description` text DEFAULT NULL,
                            `marketing_promotion_start` datetime DEFAULT NULL,
                            `marketing_promotion_end` datetime DEFAULT NULL,
                            `marketing_promotion_type` tinyint(1) DEFAULT NULL,
                            PRIMARY KEY (`marketing_promotion_id`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                )->execute();
                break;
        }

        parent::installProviding($dbPool, __DIR__ . '/nav.install.json', 'Navigation');
    }
}