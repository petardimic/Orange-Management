<?php
namespace Modules\ItemReference\Admin;
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
                            `itemreference_id` int(11) NOT NULL AUTO_INCREMENT,
                            `itemreference_name` varchar(30) DEFAULT NULL,
                            `itemreference_desc` varchar(256) DEFAULT NULL,
                            PRIMARY KEY (`itemreference_id`)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
                    )->execute();
                    break;
            }

            //parent::installProviding($db, __DIR__ . '/nav.install.json', 'Navigation');
        }
    }