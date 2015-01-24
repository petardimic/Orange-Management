<?php
namespace Web\Views\Lists;

/**
 * List view
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
class ListView extends \Framework\Views\ViewAbstract
{
    /**
     * List id
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Module
     *
     * @var int
     * @since 1.0.0
     */
    private $module = 0;

    /**
     * Page
     *
     * @var int
     * @since 1.0.0
     */
    private $pageId = 0;

    /**
     * List title
     *
     * @var string
     * @since 1.0.0
     */
    private $title = null;

    /**
     * Footer
     *
     * @var \Web\Views\Lists\PaginationView
     * @since 1.0.0
     */
    private $footer = null;

    /**
     * Header
     *
     * @var \Web\Views\Lists\HeaderView
     * @since 1.0.0
     */
    private $header = null;

    /**
     * List elements
     *
     * @var array
     * @since 1.0.0
     */
    private $elements = null;

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

    /**
     * @return PaginationView
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * @param PaginationView $footer
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;
    }

    /**
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param array $header
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param array $elements
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
    }
}
