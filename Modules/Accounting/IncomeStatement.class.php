<?php
namespace Modules\Accounting {
    /**
     * IncomeStatement class
     *
     * PHP Version 5.4
     *
     * @category   Module
     * @package    Accounting
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class IncomeStatement implements \Framework\Utils\IO\ExchangeInterface {
        private $id = 0;

        private $date = null;

        private $incomeStatement = [];

        public function __construct() {
        }

        /**
         * {@inheritdoc}
         */
        public function exportJson($path) {
        }

        /**
         * {@inheritdoc}
         */
        public function importJson($path) {
        }

        /**
         * {@inheritdoc}
         */
        public function exportCvs($path) {
        }

        /**
         * {@inheritdoc}
         */
        public function importCvs($path) {
        }

        /**
         * {@inheritdoc}
         */
        public function exportExcel($path) {
        }

        /**
         * {@inheritdoc}
         */
        public function importExcel($path) {
        }

        /**
         * {@inheritdoc}
         */
        public function exportPdf($path) {
        }

        /**
         * {@inheritdoc}
         */
        public function importPdf($path) {
        }
    }
}