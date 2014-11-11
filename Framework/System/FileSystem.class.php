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
    class FileSystem {
        private function __construct() {}

        public static function get_file_count($path, $recursive = true, $ignore = array('.','..','cgi-bin','.DS_Store')) {
            $size = 0;
            $files = scandir($path);

            foreach($files as $t) {
                if(in_array($t, $ignore)) continue;
                if (is_dir(rtrim($path, '/') . '/' . $t)) {
                    if($recursive) {
                        $size += self::get_file_count(rtrim($path, '/') . '/' . $t, true, $ignore);
                    } 
                } else {
                    $size++;
                }   
            }
            return $size;
        }
    }
}