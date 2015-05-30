<?php

class Zip
{
    public static function zip($sources, $destination, $overwrite = true)
    {
        $destination = str_replace('\\', '/', realpath($destination));

        if(!$overwrite && file_exists($destination)) {
            return false;
        }

        $zip = new ZipArchive();
        if(!$zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE)) {
            return false;
        }

        foreach($sources as $source) {
            $source = str_replace('\\', '/', realpath($source));

            if(!file_exists($source)) {
                continue;
            }

            if(is_dir($source)) {
                $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

                foreach($files as $file) {
                    $file = str_replace('\\', '/', $file);

                    /* Ignore . and .. */
                    if(in_array(substr($file, strrpos($file, '/') + 1), array('.', '..'))) {
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