<?php
namespace Framework\Core\Database {
    interface ObjectListInterface {
        public function get_object();

        public function instantiate();
    }
}