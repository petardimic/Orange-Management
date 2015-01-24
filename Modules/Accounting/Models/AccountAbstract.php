<?php
namespace Modules\Accounting\Models {
    /**
     * Account abstraction class
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
    abstract class AccountAbstract implements \Modules\Accounting\Models\AccountInterface
    {
        /**
         * Account ID
         *
         * @var int
         * @since 1.0.0
         */
        protected $id = 0;

        /**
         * Type
         *
         * @var \Modules\Accounting\Models\AccountType
         * @since 1.0.0
         */
        protected $type = null;

        /**
         * Entry list
         *
         * @var \Modules\Accounting\Models\EntryInterface[]
         * @since 1.0.0
         */
        protected $entryList = 0;

        /**
         * Constructor
         *
         * @param int $id Account ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($id)
        {
            $this->id = $id;
        }

        /**
         * Get entry
         *
         * @param int $id Entry ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getEntryByID($id)
        {
        }

        /**
         * Get entry
         *
         * @param \DateTime $start Interval start
         * @param \DateTime $end   Interval end
         * @param int       $dateType
         *
         * @internal \Modules\Accounting\Models\TimeRangeType $dateTime Time range type
         *
         * @since    1.0.0
         * @author   Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getEntriesByDate($start, $end, $dateType = \Modules\Accounting\Models\TimeRangeType::RECEIPT_DATE)
        {
        }
    }
}