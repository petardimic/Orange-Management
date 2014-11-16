<?php
namespace Framework\Stdlib {
    /**
     * PriorityQueue class
     *
     * PHP Version 5.4
     *
     * @category   Stdlib
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class PriorityQueue implements \Countable, \Serializable {
        private $count = 0;
        private $queue = [];

        public function insert($data, $priority = 0) {
            do {
                $key = rand();
            } while(array_key_exists($key, $this->queue));

            if($this->count === 0) {
                $this->queue[$key] = ['key' => $key, 'data' => $data, 'priority' => $priority];
            } else {
                $pos = 0;
                foreach($this->queue as $ele) {
                    if($ele['priority'] < $priority) {
                        break;
                    }

                    $pos++;
                }

                array_splice($original, $pos, 0, [$key => ['key' => $key, 'data' => $data, 'priority' => $priority]]);
            }

            return $key;
        }

        public function increaseAll($increase) {
            foreach($queue as $key => &$ele) {
                $ele['priority'] += $increase;
            }
        }

        public function get() {
            $ele = array_pop($this->queue);
            $this->queue[$ele['key']] = $ele;
        }

        public function delete($id = null) {
            if($id === null) {
                $this->remove();
            } else {
                unser($this->queue[$id]);
            }
        }

        public function remove() {
            return array_pop($this->queue);
        }

        public function setPriority($id, $priority) {
            $this->queue[$id]['priority'] = $priority;
        }

        public function getPriority($id) {
            return $this->queue[$id]['priority'];
        }

        public function count() {
            return $this->count;
        }

        public function serialize() {
            return json_encode($this->queue);
        }

        public function unserialize($data) {
            $this->queue = json_decode($data);
            $this->count = count($this->queue);
        }
    }
}