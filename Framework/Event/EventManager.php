<?php
namespace Framework\Event;

/**
 * EventManager class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Framework\Event
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class EventManager implements \Countable
{
    // TODO: implement persistent events (store in cache and/or db)

    /**
     * Events
     *
     * @var array
     * @since 1.0.0
     */
    private $events = [];

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
     * Attach a listener
     *
     * Listeners will get called if a certain event gets triggered
     *
     * @param string   $event    Event ID
     * @param callback $callback Function to call if the event gets triggered
     * @param string   $listener What class is attaching this listener
     *
     * @return int UID for the listener
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function attach($event, $callback, $listener)
    {
        $this->events[$event][$listener] = $callback;

        return $event . '/' . $listener;
    }

    /**
     * Trigger event
     *
     * An object fires an event
     *
     * @param string   $event    Event ID
     * @param callback $callback Callback function of the event. This will get triggered after firering all listener callbacks.
     * @param string   $source   What class is invoking this event
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function trigger($event, $callback = null, $source = null)
    {
        foreach($this->events[$event] as $event) {
            $event($source);
        }

        if($callback !== null) {
            $callback();
        }
    }

    /**
     * Trigger event
     *
     * An object fires an event until it's callback returns false
     *
     * @param string   $event    Event ID
     * @param callback $callback Callback function of the event. This will get triggered after firering all listener callbacks.
     * @param string   $source   What class is invoking this event
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function trigger_until($event, $callback = null, $source = null)
    {
        $run = true;

        do {
            foreach($this->events[$event] as $event) {
                $run = $event($source);
            }
        } while($run);

        if($callback !== null) {
            $callback();
        }
    }

    /**
     * Removing a listener
     *
     * @param int $id ID of the listener
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function detach($id)
    {
        $this->events = \Framework\Utils\ArrayUtils::unset_array($id, $this->events, '/');
    }

    /**
     * Count event listenings
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function count()
    {
        return count($this->events);
    }
}