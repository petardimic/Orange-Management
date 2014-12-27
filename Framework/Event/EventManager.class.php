<?php
namespace Framework\Event {
    /**
     * EventManager class
     *
     * PHP Version 5.4
     *
     * @category   Event
     * @package    Framework
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
        /**
         * Listener count
         *
         * @var int
         * @since 1.0.0
         */
        private $count = 0;
        // TODO: implement persistent events (store in cache and/or db)

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
         * @param string   $source   What class is attaching this listener
         *
         * @return int UID for the listener
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function attach($event, $callback, $source)
        {
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
        }

        /**
         * Removing a listener
         *
         * @param int    $id     ID of the listener
         * @param string $event  Event ID
         * @param string $source What class is detaching this listener
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function detach($id, $event = null, $source = null)
        {
        }

        /**
         * Count listeners
         *
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function count()
        {
            return $this->count;
        }
    }
}