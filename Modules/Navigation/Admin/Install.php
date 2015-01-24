<?php
namespace Modules\Navigation\Admin {
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
            /** TODO: create additional column where you can specify the url parameters that should be used in the link*/

            switch($db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $db->con->prepare(
                        'CREATE TABLE if NOT EXISTS `' . $db->prefix . 'nav` (
                            `nav_id` int(11) NOT NULL,
                            `nav_pid` varchar(40) NOT NULL,
                            `nav_name` varchar(40) NOT NULL,
                            `nav_type` tinyint(1) NOT NULL,
                            `nav_subtype` tinyint(1) NOT NULL,
                            `nav_icon` varchar(40) DEFAULT NULL,
                            `nav_l0` varchar(30) DEFAULT NULL,
                            `nav_l1` varchar(30) DEFAULT NULL,
                            `nav_l2` varchar(30) DEFAULT NULL,
                            `nav_l3` varchar(30) DEFAULT NULL,
                            `nav_l4` varchar(30) DEFAULT NULL,
                            `nav_l5` varchar(30) DEFAULT NULL,
                            `nav_from` int(11) DEFAULT NULL,
                            `nav_order` tinyint(3) DEFAULT NULL,
                            `nav_parent` int(11) DEFAULT NULL,
                            `nav_permission` int(11) DEFAULT NULL,
                            PRIMARY KEY (`nav_id`)
                        )ENGINE=InnoDB  DEFAULT CHARSET=utf8;'
                    )->execute();
                    break;
            }
        }

        /**
         * Install data from providing modules
         *
         * @param \Framework\DataStorage\Database\Database $db   Database instance
         * @param array                                    $data Module info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function installExternal(&$db, $data)
        {
            foreach($data as $link) {
                self::installExternal_link($db, $link, $link['parent']);
            }
        }

        /**
         * Install navigation element
         *
         * @param \Framework\DataStorage\Database\Database $db     Database instance
         * @param array                                    $data   Link info
         * @param int                                      $parent Parent element (default is 0 for none)
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private static function installExternal_link(&$db, $data, $parent = 0)
        {
            $sth = $db->con->prepare(
                'INSERT INTO `' . $db->prefix . 'nav` (`nav_id`, `nav_pid`, `nav_name`, `nav_type`, `nav_subtype`, `nav_icon`, `nav_l0`, `nav_l1`, `nav_l2`, `nav_l3`, `nav_l4`, `nav_l5`, `nav_from`, `nav_order`, `nav_parent`, `nav_permission`) VALUES
                        (:id, :pid, :name, :type, :subtype, :icon, :l0, :l1, :l2, :l3, :l4, :l5, :from, :order, :parent, :perm);'
            );

            $sth->bindValue(':id', $data['id'], \PDO::PARAM_INT);
            $sth->bindValue(':pid', $data['pid'], \PDO::PARAM_STR);
            $sth->bindValue(':name', $data['name'], \PDO::PARAM_STR);
            $sth->bindValue(':type', $data['type'], \PDO::PARAM_INT);
            $sth->bindValue(':subtype', $data['subtype'], \PDO::PARAM_INT);
            $sth->bindValue(':icon', $data['icon'], \PDO::PARAM_STR);
            $sth->bindValue(':l0', $data['l0'], \PDO::PARAM_STR);
            $sth->bindValue(':l1', $data['l1'], \PDO::PARAM_STR);
            $sth->bindValue(':l2', $data['l2'], \PDO::PARAM_STR);
            $sth->bindValue(':l3', $data['l3'], \PDO::PARAM_STR);
            $sth->bindValue(':l4', $data['l4'], \PDO::PARAM_STR);
            $sth->bindValue(':l5', $data['l5'], \PDO::PARAM_STR);
            $sth->bindValue(':from', $data['from'], \PDO::PARAM_INT);
            $sth->bindValue(':order', $data['order'], \PDO::PARAM_INT);
            $sth->bindValue(':parent', $parent, \PDO::PARAM_INT);
            $sth->bindValue(':perm', $data['permission'], \PDO::PARAM_INT);

            $sth->execute();

            $lastInsertID = $db->con->lastInsertId();

            foreach($data['children'] as $link) {
                $parent = ($link['parent'] == null ? $lastInsertID : $link['parent']);
                self::installExternal_link($db, $link, $parent);
            }
        }
    }
}