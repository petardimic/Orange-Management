<?php
namespace Framework\Utils\Converter {
    class File {
        public static function byteSizeToString($bytes) {
            if($bytes < 1000) {
                return $bytes . 'b';
            } elseif($bytes > 999 && $bytes < 1000000) {
                return $bytes/1000 . 'kb';
            } elseif($bytes > 999999 && $bytes < 1000000000) {
                return $bytes/1000000 . 'mb';
            } else {
                return $bytes/1000000000 . 'gb';
            }
        }
    }
}