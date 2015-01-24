<?php
namespace Framework\Stdlib;
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
    class PriorityQueue implements \Countable, \Serializable
    {
        /**
         * Queue elements
         *
         * @var int
         * @since 1.0.0
         */
        private $count = 0;

        /**
         * Queue
         *
         * @var array
         * @since 1.0.0
         */
        private $queue = [];

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
         * Insert element into queue
         *
         * @param mixed $data     Queue element
         * @param float $priority Priority of this element
         *
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function insert($data, $priority = 0.0)
        {
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

        /**
         * Increase all queue priorities
         *
         * @param float $increase Value to increase every element
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function increaseAll($increase)
        {
            foreach($this->queue as $key => &$ele) {
                $ele['priority'] += $increase;
            }
        }

        /**
         * Pop element
         *
         * @return mixed
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function get()
        {
            $ele                      = array_pop($this->queue);
            $this->queue[$ele['key']] = $ele;
        }

        /**
         * Delete element
         *
         * @param int $id Element to delete
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function delete($id = null)
        {
            if($id === null) {
                $this->remove();
            } else {
                unset($this->queue[$id]);
            }
        }

        /**
         * Delete last element
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function remove()
        {
            return array_pop($this->queue);
        }

        /**
         * Set element priority
         *
         * @param int   $id       Element ID
         * @param float $priority Element priority
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setPriority($id, $priority)
        {
            $this->queue[$id]['priority'] = $priority;
        }

        /**
         * Set element priority
         *
         * @param int $id Element ID
         *
         * @return float
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getPriority($id)
        {
            return $this->queue[$id]['priority'];
        }

        /**
         * {@inheritdoc}
         */
        public function count()
        {
            return $this->count;
        }

        /**
         * {@inheritdoc}
         */
        public function serialize()
        {
            return json_encode($this->queue);
        }

        /**
         * {@inheritdoc}
         */
        public function unserialize($data)
        {
            $this->queue = json_decode($data);
            $this->count = count($this->queue);
        }
    }