<?php
namespace Psr\Http\Message;

/**
 * Value object representing a file uploaded through an HTTP request.
 */
interface UploadedFileInterface
{
    /**
     * Retrieve a stream representing the uploaded file.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStream();

    /**
     * Move the uploaded file to a new location.
     *
     * @param string $targetPath Path to new location
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function moveTo($targetPath);

    /**
     * Retrieve the file size.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getSize();

    /**
     * Retrieve the error associated with the uploaded file.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getError();

    /**
     * Retrieve the filename sent by the client.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getClientFilename();

    /**
     * Retrieve the media type sent by the client.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getClientMediaType();
}