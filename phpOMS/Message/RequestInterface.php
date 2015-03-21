<?php
namespace phpOMS\Message;

/**
 * Request interface
 *
 * PHP Version 5.4
 *
 * @category   Request
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface RequestInterface
{
    /**
     * Get request source
     *
     * @return \phpOMS\Message\RequestSource
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getRequestSource();

    /**
     * Set request source
     *
     * @param \phpOMS\Message\RequestSource $source Source of the request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setRequestSource($source);

    /**
     * Get request
     *
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getRequest();

    /**
     * Get request type
     *
     * @return \phpOMS\Message\RequestMethod
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getMethod();

    /**
     * Get request info
     *
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getRequestInfo();

    /**
     * Get request
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getUri();

    /**
     * Get language
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLanguage();

    /**
     * Get request origin
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getOrigin();

    /**
     * Get hash
     *
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getHash();
}