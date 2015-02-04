<?php
namespace Web\Views;

/**
 * Web view abstract
 *
 * PHP Version 5.4
 *
 * @category   Theme
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class WebViewAbstract extends \Framework\Views\ViewAbstract
{
    /**
     * Panel id
     *
     * @var int
     * @since 1.0.0
     */
    protected $id = 0;

    /**
     * Module
     *
     * @var int
     * @since 1.0.0
     */
    protected $module = 0;

    /**
     * Page
     *
     * @var int
     * @since 1.0.0
     */
    protected $pageId = 0;

    /**
     * View title
     *
     * @var string
     * @since 1.0.0
     */
    protected $title = '';

    /**
     * {@inheritdoc}
     */
    public function __construct($l11n)
    {
        parent::__construct($l11n);
    }

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
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param int $module
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setModule($module)
    {
        $this->module = $module;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @param int $pageId
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}