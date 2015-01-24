<?php
namespace Modules\Accounting\Models;

/**
 * BatchPosting class
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
class BatchPosting implements \Framework\Utils\IO\ExchangeInterface, \Countable
{
    /**
     * ID
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Creator
     *
     * @var int
     * @since 1.0.0
     */
    private $creator = null;

    /**
     * Created
     *
     * @var \Datetime
     * @since 1.0.0
     */
    private $created = null;

    /**
     * Description
     *
     * @var string
     * @since 1.0.0
     */
    private $description = null;

    /**
     * Postings
     *
     * @var \Modules\Accounting\Models\PostingAbstract[]
     * @since 1.0.0
     */
    private $postings = [];

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
     * Get id
     *
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
     * Set id
     *
     * @param int $id Batch ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set description
     *
     * @param string $desc Description
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDescription($desc)
    {
    }

    /**
     * Get description
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set creator
     *
     * @param \Datetime $created Created
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return \Datetime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get creator
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set creator
     *
     * @param int $creator Creator ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

    /**
     * Get posting
     *
     * @param int $id Posting ID
     *
     * @return \Modules\Accounting\Models\PostingAbstract
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPosting($id)
    {
        return $this->postings[$id];
    }

    /**
     * Remove posting
     *
     * @param int $id Posting ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function removePosting($id)
    {
        unset($this->postings[$id]);
    }

    /**
     * Add posting
     *
     * @param \Modules\Accounting\Models\PostingAbstract $posting Posting
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addPosting($posting)
    {
        $this->postings[] = $posting;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->postings);
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