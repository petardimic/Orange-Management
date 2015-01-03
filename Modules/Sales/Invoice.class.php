<?php
namespace Modules\Sales {
    /**
     * Sales invoice class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Modules\Sales
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Invoice implements \Framework\Object\ObjectInterface
    {
        /**
         * Database instance
         *
         * @var \Framework\DataStorage\Database\Database
         * @since 1.0.0
         */
        private $db = null;

        private $id = null;

        private $referer = null;

        private $reference = null;

        private $orderer = null;

        private $ordered = null;

        private $creator = null;

        private $created = null;

        private $client = null;

        private $deliveryAddress = null;

        private $billingAddress = null;

        private $payment = null;

        private $delivery = null;

        private $freightage = null;

        private $invoiceItemList = [];

        private $info = '';

        private $status = null;

        private $price = null;

        private $currency = null;

        /**
         * Constructor
         *
         * @param \Framework\DataStorage\Database\Database $db Database instance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($db)
        {
            $this->db = $db;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param null $id
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getReference()
        {
            return $this->reference;
        }

        /**
         * @param null $reference
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setReference($reference)
        {
            $this->reference = $reference;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getOrderer()
        {
            return $this->orderer;
        }

        /**
         * @param null $orderer
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setOrderer($orderer)
        {
            $this->orderer = $orderer;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getOrdered()
        {
            return $this->ordered;
        }

        /**
         * @param null $ordered
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setOrdered($ordered)
        {
            $this->ordered = $ordered;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getCreator()
        {
            return $this->creator;
        }

        /**
         * @param null $creator
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setCreator($creator)
        {
            $this->creator = $creator;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getCreated()
        {
            return $this->created;
        }

        /**
         * @param null $created
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setCreated($created)
        {
            $this->created = $created;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getClient()
        {
            return $this->client;
        }

        /**
         * @param null $client
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setClient($client)
        {
            $this->client = $client;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getDeliveryAddress()
        {
            return $this->deliveryAddress;
        }

        /**
         * @param null $deliveryAddress
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setDeliveryAddress($deliveryAddress)
        {
            $this->deliveryAddress = $deliveryAddress;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getBillingAddress()
        {
            return $this->billingAddress;
        }

        /**
         * @param null $billingAddress
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setBillingAddress($billingAddress)
        {
            $this->billingAddress = $billingAddress;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getPayment()
        {
            return $this->payment;
        }

        /**
         * @param null $payment
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setPayment($payment)
        {
            $this->payment = $payment;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getDelivery()
        {
            return $this->delivery;
        }

        /**
         * @param null $delivery
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setDelivery($delivery)
        {
            $this->delivery = $delivery;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getFreightage()
        {
            return $this->freightage;
        }

        /**
         * @param null $freightage
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setFreightage($freightage)
        {
            $this->freightage = $freightage;
        }

        /**
         * @return array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getInvoiceItemList()
        {
            return $this->invoiceItemList;
        }

        /**
         * @param array $invoiceItemList
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setInvoiceItemList($invoiceItemList)
        {
            $this->invoiceItemList = $invoiceItemList;
        }

        /**
         * {@inheritdoc}
         */
        public function serialize()
        {
            // TODO: Implement serialize() method.
        }

        /**
         * {@inheritdoc}
         */
        public function unserialize($serialized)
        {
            // TODO: Implement unserialize() method.
        }

        /**
         * {@inheritdoc}
         */
        public function delete()
        {
            // TODO: Implement delete() method.
        }

        /**
         * {@inheritdoc}
         */
        public function create()
        {
            // TODO: Implement create() method.
        }

        /**
         * {@inheritdoc}
         */
        public function update()
        {
            // TODO: Implement update() method.
}

        /**
         * {@inheritdoc}
         */
        public function init($id)
        {
            // TODO: Implement init() method.
        }

        public function getPrice() {

        }

        public function getDiscount() {

        }

        public function getDiscountP() {

        }

        public function getProfit() {

        }

        public function getGrossProfit() {

        }

        public function getPayed() {

        }

        /**
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getInfo()
        {
            return $this->info;
        }

        /**
         * @param string $info
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setInfo($info)
        {
            $this->info = $info;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * @param null $status
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setStatus($status)
        {
            $this->status = $status;
        }
    }
}