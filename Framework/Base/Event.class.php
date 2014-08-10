<?php
namespace Framework\Base {
    interface Event {
        public function subscribe($obj, $trigger, $func);
        public function unsubscribe($obj);
        public function trigger($trigger);
    }
}