<?php
namespace Modules\Warehousing\Models;

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
class Shipping implements \phpOMS\Models\MapperInterface, \phpOMS\Pattern\Multition
{
    /**
     * ID
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

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
     * @var \phpOMS\Datatypes\Address
     * @since 1.0.0
     */
    private $to = null;

    /**
     * Warehouse
     *
     * @var int
     * @since 1.0.0
     */
    private $warehouse = '';

    /**
     * Date of arrival
     *
     * @var \Datetime
     * @since 1.0.0
     */
    private $delivered = null;

    /**
     * Person who sent the delivery
     *
     * @var int
     * @since 1.0.0
     */
    private $sender = null;

    /**
     * Warehouse
     *
     * @var \Modules\Warehousing\Models\ArrivalStatus
     * @since 1.0.0
     */
    private $status = null;

    /**
     * Shipping
     *
     * @var \Modules\Warehousing\Models\Article[]
     * @since 1.0.0
     */
    private static $instances = [];

    /**
     * Constructor
     *
     * @param int $id Article ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function init($id)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function __clone()
    {
    }

    /**
     * Initializing object
     *
     * @param int $id Article ID
     *
     * @return \Modules\Warehousing\Models\Article
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getInstance($id)
    {
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
    public function getID()
    {
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
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set order
     *
     * @param int $order Order ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * Get delivered
     *
     * @return \Datetime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * Set delivered
     *
     * @param \Datetime $delivered Date of delivery
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDelivered($delivered)
    {
        $this->delivered = $delivered;
    }

    /**
     * Get To
     *
     * @return \phpOMS\Datatypes\Address
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set To
     *
     * @param \phpOMS\Datatypes\Address $to Receiver
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * Get status
     *
     * @return \Modules\Warehousing\Models\ArrivalStatus
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param  \Modules\Warehousing\Models\ArrivalStatus
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get warehouse
     *
     * @return \Modules\Warehousing\Models\Warehouse
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getWarehouse()
    {
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
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set sender
     *
     * @param int $sender Person who accepted the consignment
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * {@inheritdoc}
     */
    public function delete()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function update()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($data)
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