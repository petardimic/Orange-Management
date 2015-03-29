<?php
namespace phpOMS\Event;

/**
 * EventManager class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Event
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 *
 * @todo: make cachable + database storable -> can reload user defined listeners (persistent events)
 */
class EventManager implements \phpOMS\Pattern\Mediator
{
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
     * {@inheritdoc}
     */
    public function attach($event, $callback, $listener)
    {
        $this->events[$event][$listener] = $callback;

        return $event . '/' . $listener;
    }

    /**
     * {@inheritdoc}
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
    public function triggerUntil($event, $callback = null, $source = null)
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
     * {@inheritdoc}
     */
    public function detach($event)
    {
        $this->events = \phpOMS\Utils\ArrayUtils::unset_array($event, $this->events, '/');
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
