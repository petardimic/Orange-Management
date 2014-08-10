<?php
namespace Framework\Core\Database {
    interface ObjectInterface extends \Serializable {
        public function delete();
        public function create();
    }
}