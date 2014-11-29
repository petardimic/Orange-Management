<?php
namespace Framework\Utils\IO\Excel {
    /**
     * Excel interface
     *
     * PHP Version 5.4
     *
     * @category   Framework
     * @package    Utils
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    interface ExcelInterface {
        /**
         * Export Excel
         *
         * @param string $path Path to export
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function exportExcel($path);

        /**
         * Import Excel
         *
         * @param string $path Path to import
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function importExcel($path);
    }
}