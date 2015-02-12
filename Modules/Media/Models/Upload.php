<?php
namespace Modules\Media\Models;

/**
 * Upload
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Media
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Upload
{
    /**
     * Upload max size
     *
     * @var int
     * @since 1.0.0
     */
    private $maxSize = 0;

    /**
     * Allowed mime types
     *
     * @var array
     * @since 1.0.0
     */
    private $allowedTypes = [];

    /**
     * Output directory
     *
     * @var string
     * @since 1.0.0
     */
    private $outputDir = '';

    /**
     * Output file name
     *
     * @var string
     * @since 1.0.0
     */
    private $fileName = '';

    /**
     * Upload file to server
     *
     * @param array $FILE File data ($_FILE)
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function upload($FILE)
    {
        if(!isset($FILE['upfile']['error']) || is_array($FILE['upfile']['error'])) {
            // TODO: handle wrong parameters
            return;
        }

        switch($FILE['upfile']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                // TODO: no file sent
                return;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                // too large
                return;
            default:
                return;
        }

        if($FILE['upfile']['size'] > $this->maxSize) {
            // too large2
            return;
        }

        // TODO: do I need pecl fileinfo?
        $finfo = new \finfo(FILEINFO_MIME_TYPE);

        if(false === $ext = array_search($finfo->file($FILE['upfile']['tmp_name']), $this->allowedTypes, true)) {
            // wrong file format
            return;
        }

        if(!move_uploaded_file($FILE['upfile']['tmp_name'], $this->outputDir . '/' . $this->fileName)) {
            // couldn't move
            return;
        }
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getMaxSize()
    {
        return $this->maxSize;
    }

    /**
     * @param int $maxSize
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setMaxSize($maxSize)
    {
        $this->maxSize = $maxSize;
    }

    /**
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getAllowedTypes()
    {
        return $this->allowedTypes;
    }

    /**
     * @param array $allowedTypes
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setAllowedTypes($allowedTypes)
    {
        $this->allowedTypes = $allowedTypes;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getOutputDir()
    {
        return $this->outputDir;
    }

    /**
     * @param string $outputDir
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setOutputDir($outputDir)
    {
        $this->outputDir = $outputDir;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }
}