<?php
namespace phpOMS/Datatypes/ExactFloat;

class ExactFloat {
    private static $length = 0;
    
    public static function setLength($length) {
        $length = (int) $length;
    }
    
    public static function add($a, $b, $length = null) {
        $a = strval($a);
        $b = strval($b);
        
        
    }
    
    public static function sub($a, $b, $length = null) {
        
    }
    
    public static function mult($a, $b, $length = null) {
        
    }
    
    public static function div($a, $b, $length = null) {
        
    }
    
    public static function __toString() {
        
    }
}
