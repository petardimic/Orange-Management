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
    class EventManager implements \Countable {
        // TODO: implement persistent events (store in cache and/or db)
        public function __construct() {

        }

        public function attach($event, $callback, $source) {

        }

        // callback = callback of the triggering class in case it needs to do something afterwards
        public function trigger($event, $callback = null, $source = null) {

        }

        public function trigger_until($event, $callback = null, $source = null) {

        }

        public function detach($id, $event = null, $source = null)
    }
}