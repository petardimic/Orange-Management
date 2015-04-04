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
interface Mediator extends \Countable
{
    /**
     * Attach a listener
     *
     * Listeners will get called if a certain event gets triggered
     *
     * @param string   $event    Event ID
     * @param Callable $callback Function to call if the event gets triggered
     * @param string   $listener What class is attaching this listener
     *
     * @return int UID for the listener
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function attach($event, $callback, $listener);

    /**
     * Removing a listener
     *
     * @param int $event ID of the listener
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function detach($event);

    /**
     * Trigger event
     *
     * An object fires an event
     *
     * @param string   $event    Event ID
     * @param Callable $callback Callback function of the event. This will get triggered after firering all listener callbacks.
     * @param string   $source   What class is invoking this event
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function trigger($event, $callback = null, $source = null);
}
