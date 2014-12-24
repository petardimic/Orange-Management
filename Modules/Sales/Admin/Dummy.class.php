<?php
namespace Modules\Sales\Admin {
    /**
     * Dummy class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Sales
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Dummy implements \Framework\Install\DummyInterface {
        /**
         * {@inheritdoc}
         */
        public static function generate($db, $amount) {
            $dataString = '';

            for($i = 0; $i < $amount; $i++) {
                $dataString .= " ('" . \Framework\Utils\RnG\String::generateString(5, 15) . "', " . rand(1, $amount - 1) . "),";
            }

            $dataString = rtrim($dataString, ',');

            $db->con->prepare('INSERT INTO `' . $db->prefix . 'sales_client` (`matchcode`, `account`) VALUES ' . $dataString)->execute();
        }
    }
}