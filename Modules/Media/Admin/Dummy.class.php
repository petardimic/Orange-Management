<?php
namespace Modules\Media\Admin {
    class Dummy implements \Framework\Install\DummyInterface {
        public static function generate($db, $amount) {
            $dataString = '';
            $fileTypes  = ['jpg', 'png', 'pdf', 'doc', 'gif', 'mp4', 'mp3', 'exe', 'zip', 'rar'];

            for($i = 0; $i < $amount-1; $i++) {
                $dataString .= " ( '" . \Framework\Utils\RnG\String::generateString(5, 15) . "', '', '" . $fileTypes[rand(0, count($fileTypes) - 1)] . "', 1, '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "' ),";
            }

            $dataString .= " ( '" . \Framework\Utils\RnG\String::generateString(5, 15) . "', '', '" . $fileTypes[rand(0, count($fileTypes) - 1)] . "', 1, '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "')";

            $db->con->prepare('INSERT INTO `' . $db->prefix . 'media` (`name`, `file`, `type`, `creator`, `created`) VALUES ' . $dataString)->execute();
        }
    }
}