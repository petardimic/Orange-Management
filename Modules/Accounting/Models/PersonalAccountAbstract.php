<?php
namespace Modules\Accounting\Models;
    /**
     * ImpersonalAccount class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Modules\Accounting\Models
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class PersonalAccount extends AccountAbstract implements \Framework\Utils\IO\ExchangeInterface
    {
        protected $id = 0;



        public function __construct()
        {
        }

        public function getBalance()
        {
        }

        public function getAccountsReceivable()
        {
        }

        public function getAccountsPayable()
        {
        }

        public function getAccountsHistory($start, $end)
        {
        }

        /**
         * {@inheritdoc}
         */
        public function exportJson($path)
        {
        }

        /**
         * {@inheritdoc}
         */
        public function importJson($path)
        {
        }

        /**
         * {@inheritdoc}
         */
        public function exportCsv($path)
        {
        }

        /**
         * {@inheritdoc}
         */
        public function importCsv($path)
        {
        }

        /**
         * {@inheritdoc}
         */
        public function exportExcel($path)
        {
        }

        /**
         * {@inheritdoc}
         */
        public function importExcel($path)
        {
        }

        /**
         * {@inheritdoc}
         */
        public function exportPdf($path)
        {
        }

        /**
         * {@inheritdoc}
         */
        public function importPdf($path)
        {
        }
    }