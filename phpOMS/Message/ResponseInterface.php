<?php
namespace phpOMS\Message;

/**
 * Response interface
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Response
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface ResponseInterface
{
    /**
     * Add header by ID
     *
     * @param mixed  $key       Header ID
     * @param string $header    Header string
     * @param bool   $overwrite Overwrite existing headers
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addHeader($key, $header, $overwrite = true);
}