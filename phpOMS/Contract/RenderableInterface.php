<?php
namespace phpOMS\Contract;

/**
 * Make a class renderable
 *
 * This is primarily used for classes that provide formatted output or output,
 * that get's rendered in third party applications.
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Contract
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface RenderableInterface
{
    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function render();
}
