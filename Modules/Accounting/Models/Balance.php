<?php
namespace Modules\Accounting\Models;

/**
 * Balance class
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
abstract class Balance implements \Framework\Utils\IO\ExchangeInterface
{
    /**
     * ID
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Date of the balance
     *
     * @var \Datetime
     * @since 1.0.0
     */
    private $date = null;

    /**
     * Balance data
     *
     * @var array
     * @since 1.0.0
     */
    private $balance = [
        'credit' => [
            'capital'     => [],
            'circulating' => []
        ],
        'debit'  => [
            'equity' => [],
            'debt'   => []
        ]
    ];

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
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