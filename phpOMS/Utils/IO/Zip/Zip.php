<?php

namespace phpOMS\Utils\IO\Zip;

/**
 * Zip class for handling zip files
 *
 * Providing basic zip support
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Asset
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Zip
{
    /**
     * Create zip
     *
     * @param string[] $sources     Files and directories to compress
     * @param string   $destination Output destination
     * @param boolean  $overwrite   Overwrite if destination is existing
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function zip($sources, $destination, $overwrite = true)
    {
        $destination = str_replace('\\', '/', realpath($destination));

        if(!$overwrite && file_exists($destination)) {
            return false;
        }

        $zip = new \ZipArchive();
        if(!$zip->open($destination, $overwrite ? \ZIPARCHIVE::OVERWRITE : \ZIPARCHIVE::CREATE)) {
            return false;
        }

        foreach($sources as $source) {
            $source = str_replace('\\', '/', realpath($source));

            if(!file_exists($source)) {
                continue;
            }

            if(is_dir($source)) {
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source), \RecursiveIteratorIterator::SELF_FIRST);

                foreach($files as $file) {
                    $file = str_replace('\\', '/', $file);

                    /* Ignore . and .. */
                    if(in_array(substr($file, strrpos($file, '/') + 1), ['.', '..'])) {
                        continue;
                    }

                    $file = realpath($file);

                    if(is_dir($file)) {
                        $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                    } elseif(is_file($file)) {
                        $zip->addFile(str_replace($source . '/', '', $file), $file);
                    }
                }
            } elseif(is_file($source)) {
                $zip->addFile(basename($source), $source);
            }
        }

        return $zip->close();
    }
}