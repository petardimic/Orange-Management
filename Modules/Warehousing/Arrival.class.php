<?php
namespace Modules\Warehousing {
    /**
     * Warehouse class
     *
     * PHP Version 5.4
     *
     * @category   Warehousing
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Arrival implements \Framework\Object\ObjectInterface, \Framework\Pattern\Multition {
        /**
         * ID
         *
         * @var int
         * @since 1.0.0
         */
        private $id = '';

        /**
         * Order
         *
         * @var int
         * @since 1.0.0
         */
        private $order = '';

        /**
         * From
         *
         * @var \Framework\Datatypes\Address
         * @since 1.0.0
         */
        private $from = null;

        /**
         * Warehouse
         *
         * @var \Modules\Warehousing\Warehouse
         * @since 1.0.0
         */
        private $warehouse = null;

        /**
         * Date of arrival
         *
         * @var \Datetime
         * @since 1.0.0
         */
        private $date = null;

        /**
         * Person who accepted the delivery
         *
         * @var int
         * @since 1.0.0
         */
        private $acceptor = null;

        /**
         * Warehouse
         *
         * @var \Modules\Warehousing\ArrivalStatus
         * @since 1.0.0
         */
        private $status = null;

        /* TODO: count, packaging, product count etc.... for every single position + where do you put it */

        /**
         * Arrival
         *
         * @var \Modules\Warehousing\Arrival[]
         * @since 1.0.0
         */
        private static $instances = [];

        /**
         * Constructor
         *
         * @param int $id Arrival ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        private function __construct($id) {
            $this->id = $id;
        }

        /**
         * {@inheritdoc}
         */
        public function __clone() {
        }

        /**
         * Initializing object
         *
         * @param int $id Arrival ID
         *
         * @return \Modules\Warehousing\Arrival
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getInstance($id) {
            if(!isset(self::$instances[$id])) {
                self::$instances[$id] = new self($id);
            }

            return self::$instances[$id];
        }

        /**
         * Get ID
         *
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getID() {
            return $this->id;
        }

        /**
         * Get order
         *
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getOrder() {
            return $this->order;
        }

        /**
         * Set order
         *
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setOrder($order) {
            $this->order = $order;
        }

        /**
         * Get From
         *
         * @return \Framework\Datatypes\Address
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getFrom() {
            return $this->from;
        }

        /**
         * Set From
         *
         * @return \Framework\Datatypes\Address
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setFrom($from) {
            $this->from = $from;
        }

        /**
         * Get status
         *
         * @return \Modules\Warehousing\ArrivalStatus
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getStatus() {
            return $this->status;
        }

        /**
         * Set status
         *
         * @param  \Modules\Warehousing\ArrivalStatus
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setStatus($status) {
            $this->status = $status;
        }

        /**
         * Get warehouse
         *
         * @return \Modules\Warehousing\Warehouse
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getWarehouse() {
            return $this->warehouse;
        }

        /**
         * Get acceptor
         *
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getAcceptor() {
            return $this->acceptor;
        }

        /**
         * Set acceptor
         *
         * @param int $acceptor Person who accepted the consignment
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setAcceptor($acceptor) {
            $this->acceptor = $acceptor;
        }

        /**
         * {@inheritdoc}
         */
        public function delete() {
        }

        /**
         * {@inheritdoc}
         */
        public function create() {
        }

        /**
         * {@inheritdoc}
         */
        public function update() {
        }

        /**
         * {@inheritdoc}
         */
        public function serialize() {
        }

        /**
         * {@inheritdoc}
         */
        public function unserialize($data) {
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
        public function exportCsv($path) {
        }

        /**
         * {@inheritdoc}
         */
        public function importCsv($path) {
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