<?php
namespace phpOMS\Pattern;

/**
 * Mediator
 *
 * PHP Version 5.4
 *
 * @category   Pattern
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface Mediator
{
    public function attach($event, $callback);

    public function detach($event);

    public function trigger($event, $data = null);
}
