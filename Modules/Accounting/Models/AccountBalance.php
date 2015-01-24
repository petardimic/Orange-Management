<?php
namespace Modules\Accounting\Models {
    /**
     * Account balance class
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
    abstract class AccountBalance
    {
        /**
         * Time range start
         *
         * @var \DateTime
         * @since 1.0.0
         */
        private $start = null;

        /**
         * Time range end
         *
         * @var \DateTime
         * @since 1.0.0
         */
        private $end = null;

        /**
         * Time range type
         *
         * @var \Modules\Accounting\Models\TimeRangeType
         * @since 1.0.0
         */
        private $rangetype = null;

        /**
         * Account
         *
         * @var \Modules\Accounting\Models\AccountInterface
         * @since 1.0.0
         */
        private $account = null;

        /**
         * Balance
         *
         * @var float
         * @since 1.0.0
         */
        private $balance = null;

        /**
         * Constructor
         *
         * @param int $id Arrival ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($id)
        {
            $this->id = $id;
        }

        /**
         * @return \DateTime
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getStart()
        {
            return $this->start;
        }

        /**
         * @param \DateTime $start
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setStart($start)
        {
            $this->start = $start;
        }

        /**
         * @return \DateTime
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getEnd()
        {
            return $this->end;
        }

        /**
         * @param \DateTime $end
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setEnd($end)
        {
            $this->end = $end;
        }

        /**
         * @return TimeRangeType
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getRangetype()
        {
            return $this->rangetype;
        }

        /**
         * @param TimeRangeType $rangetype
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setRangetype($rangetype)
        {
            $this->rangetype = $rangetype;
        }

        /**
         * @return AccountInterface
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getAccount()
        {
            return $this->account;
        }

        /**
         * @param AccountInterface $account
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setAccount($account)
        {
            $this->account = $account;
        }

        /**
         * @return float
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getBalance()
        {
            return $this->balance;
        }

        /**
         * @param float $balance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setBalance($balance)
        {
            $this->balance = $balance;
        }


    }
}