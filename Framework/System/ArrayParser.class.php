<?php
namespace Framework\System {
    class ArrayParser {
        public $file = null;
        public $module_array = null;

        public function __construct($file, $arr_name) {
            if (file_exists($file)) {
                $this->file = $file;

                /** @noinspection PhpIncludeInspection */
                include $this->file;

                if (isset(${$arr_name})) {
                    $this->module_array = ${$arr_name};
                }
            }
        }

        public function set($id, $val) {
            $this->module_array[$id] = $val;
        }

        public function delete($id) {
            unset($this->module_array[$id]);
        }

        public function save($name) {
            $arr = '<' . '?php' . PHP_EOL
                . '$' . $name . ' = [' . PHP_EOL
                . $this->serialize_array($this->module_array)
                . '];';

            file_put_contents($this->file, $arr);
        }

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