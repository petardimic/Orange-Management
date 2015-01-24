<?php
namespace Framework\Utils\IO\Pdf;
    /**
     * Pdf interface
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
    interface PdfInterface
    {
        /**
         * Export Pdf
         *
         * @param string $path Path to export
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function exportPdf($path);
    }