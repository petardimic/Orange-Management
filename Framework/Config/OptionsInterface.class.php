<?php
namespace Framework\Config {
    /**
     * Options class
     *
     * PHP Version 5.4
     *
     * @category   Config
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    interface OptionsInterface {
        /**
         * Updating or adding settings
         *
         * @param mixed $key Unique option key
         * @param mixed $value Option value
         * @param bool $storable Is this option storable inside DB or cache
         * @param bool $save Should this update the database/cache
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function set_option($key, $value, $storeable = false, $save = false);

        /**
         * Get option by key
         *
         * @param mixed $key Unique option key
         *
         * @return mixed Option value
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function get_option($key);

        /**
         * Update options (push them into DB and Cache)
         * 
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function update();
    }
}