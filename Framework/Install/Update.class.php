<?php
namespace Framework\Install {
    /**
     * Update class
     *
     * PHP Version 5.4
     *
     * @category   Install
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Update {
        /* TODO: remove relative elements (security) and only allow paths in this application */
        public static function replace($old, $new) {
            unlink($old);
            rename('somewhere_in_temp_folder/' . $new, $old);
        }

        public static function remove($old) {
            unlink($old);
        }
    }
}