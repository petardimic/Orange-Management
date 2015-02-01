<?php
namespace Web\Views\Lists;

/**
 * Header view
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
class HeaderView extends \Framework\Views\ViewAbstract
{
    /**
     * Header elements
     *
     * @var array
     * @since 1.0.0
     */
    private $elements = [];

    /**
     * Table title
     *
     * @var string
     * @since 1.0.0
     */
    private $title = '';

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

    /**
     * Add element to header
     *
     * @param array $element
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addElement($element)
    {
        $this->elements += $element;
    }

    /**
     * Remove element by id
     *
     * @param mixed $id Elment id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function removeElement($id)
    {
        if(isset($this->elements[$id])) {
            unset($this->elements[$id]);
        }
    }
}
