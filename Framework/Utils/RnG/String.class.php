<?php
namespace Framework\Utils\RnG {
    class String {
        public static function generateRandomString($min = 10, $max = 10, $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
            $length = rand($min, $max);
            $charactersLength = strlen($charset);
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $charset[rand(0, $charactersLength - 1)];
            }

            return $randomString;
        }
    }
}