<?php
namespace phpOMS\Utils\Converter;

/**
 * File converter
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Converter
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class File
{
    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function __construct()
    {
    }

    /**
     * Get file size string
     *
     * @param int $bytes Amount of bytes
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function byteSizeToString($bytes)
    {
        if($bytes < 1000) {
            return $bytes . 'b';
        } elseif($bytes > 999 && $bytes < 1000000) {
            return $bytes / 1000 . 'kb';
        } elseif($bytes > 999999 && $bytes < 1000000000) {
            return $bytes / 1000000 . 'mb';
        } else {
            return $bytes / 1000000000 . 'gb';
        }
    }
}