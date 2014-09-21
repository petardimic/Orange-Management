<?php
namespace Framework\System {
    /**
     * Array parser class
     *
     * Parsing/serializing arrays to and from php file
     *
     * PHP Version 5.4
     *
     * @category   System
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class ArrayParser {
        /**
         * File path
         *
         * @var string
         * @since 1.0.0
         */
        public $file = null;

        /**
         * File path
         *
         * @var array
         * @since 1.0.0
         */
        public $array = null;

        /**
         * Constructor
         *
         * @param string $file File path
         * @param ref $arr_name Array to parse
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($file, $arr_name) {
            if (file_exists($file)) {
                $this->file = $file;

                /** @noinspection PhpIncludeInspection */
                include $this->file;

                if (isset(${$arr_name})) {
                    $this->array = ${$arr_name};
                }
            }
        }

        /**
         * Set or add new value
         *
         * @param mixed $id Array ID to add/edit
         * @param mixed $val Value to add/insert
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function set($id, $val) {
            $this->array[$id] = $val;
        }

        /**
         * Remove value
         *
         * @param mixed $id Array ID to add/edit
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function delete($id) {
            unset($this->array[$id]);
        }

        /**
         * Saving array to file
         *
         * @param string $name Name of new array
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function save($name) {
            $arr = '<' . '?php' . PHP_EOL
                . '$' . $name . ' = [' . PHP_EOL
                . $this->serialize_array($this->array)
                . '];';

            file_put_contents($this->file, $arr);
        }

        /**
         * Serializing array (recursively)
         *
         * @param array $arr Array to serialize
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function serialize_array($arr) {
            foreach ($arr as $key => $val) {
                if (is_array($val)) {
                    if (is_string($key)) {
                        return '"' . $key . '" => [' . PHP_EOL . $this->serialize_array($val) . PHP_EOL . '],' . PHP_EOL;
                    } else {
                        return $key . ' => [' . PHP_EOL . $this->serialize_array($val) . PHP_EOL . '],' . PHP_EOL;
                    }
                } elseif (is_null($val)) {
                    if (is_string($key)) {
                        return '"' . $key . '" => null';
                    } else {
                        return $key . ' => null,' . PHP_EOL;
                    }
                } else {
                    if (is_string($key)) {
                        return '"' . $key . '" => ' . $val . ',' . PHP_EOL;
                    } else {
                        return $key . ' => ' . $val . ',' . PHP_EOL;
                    }
                }
            }
        }
    }
}