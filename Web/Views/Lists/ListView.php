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
class ListView extends \Web\Views\WebViewAbstract
{
    /**
     * List elements
     *
     * @var array
     * @since 1.0.0
     */
    protected $elements = null;

    /**
     * Row freeze
     *
     * @var int
     * @since 1.0.0
     */
    protected $hFreeze = 0;

    /**
     * Columng freeze
     *
     * @var int
     * @since 1.0.0
     */
    protected $vFreeze = 0;

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
     * @param array $elements
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addElements($elements)
    {
        $this->elements[] = $elements;
    }

    /**
     * Set freezes
     *
     * @param int $horizontal Row to freeze
     * @param int $vertical Column to freeze
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFreeze($horizontal = 0, $vertical = 0) {
        $this->hFreeze = $horizontal;
        $this->vFreeze = $vertical;
    }
}
