<?php
namespace Modules\DataEvaluation\Admin;
/**
 * Data evaluation install class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\DataEvaluation
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
     * @param \Framework\DataStorage\Database\Pool $dbPool   Database pool instance
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
                    'CREATE TABLE if NOT EXISTS `' . $dbPool->get('core')->prefix . 'dataeval_evaluation` (
                            `dataeval_id` int(11) NOT NULL AUTO_INCREMENT,
                            `dataeval_title` varchar(25) NOT NULL,
                            `dataeval_desc` varchar(255) NOT NULL,
                            `dataeval_creator` int(11) NOT NULL,
                            `dataeval_created` datetime NOT NULL,
                            PRIMARY KEY (`dataeval_id`),
                            KEY `dataeval_creator` (`dataeval_creator`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                )->execute();
                
                $dbPool->get('core')->con->prepare(
                    'ALTER TABLE `' . $dbPool->get('core')->prefix . 'dataeval_evaluation`
                            ADD CONSTRAINT `' . $dbPool->get('core')->prefix . 'dataeval_evaluation_ibfk_1` FOREIGN KEY (`dataeval_creator`) REFERENCES `' . $dbPool->get('core')->prefix . 'account` (`account_id`);'
                )->execute();
                break;
        }
        parent::installProviding($dbPool, __DIR__ . '/nav.install.json', 'Navigation');
    }
}
