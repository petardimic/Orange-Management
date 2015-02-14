<?php
namespace Web\Views\Form;

/**
 * Form view
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
class FormView extends \Web\Views\WebViewAbstract
{
    /**
     * Elements
     *
     * @var array
     * @since 1.0.0
     */
    protected $elements = [];

    /**
     * Has own submit button
     *
     * @var bool
     * @since 1.0.0
     */
    protected $hasSubmit = true;

    /**
     * Url for request
     *
     * @var string
     * @since 1.0.0
     */
    protected $action = '';

    /**
     * Request method
     *
     * @var \phpOMS\Message\RequestType
     * @since 1.0.0
     */
    protected $method = \phpOMS\Message\RequestType::POST;

    /**
     * {@inheritdoc}
     */
    public function __construct($l11n)
    {
        parent::__construct($l11n);
    }

    /**
     * @param mixed $row    Element row
     * @param mixed $column Element column
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getElement($row, $column)
    {
        return $this->elements[$row][$column];
    }

    /**
     * @param mixed $row     Element row
     * @param mixed $column  Element column
     * @param array $element Element
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setElement($row, $column, $element)
    {
        $this->elements[$row][$column] = $element;
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
     * @param mixed $elements
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
    }

    /**
     * @return boolean
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function isHasSubmit()
    {
        return $this->hasSubmit;
    }

    /**
     * @param boolean $hasSubmit
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setHasSubmit($hasSubmit)
    {
        $this->hasSubmit = $hasSubmit;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return \phpOMS\Message\RequestType
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param \phpOMS\Message\RequestType|string $method
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }
}