<?php
namespace Web\Views\Page;

/**
 * Backend view
 *
 * PHP Version 5.4
 *
 * @category   Theme
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class GenericView extends \phpOMS\Views\View
{
    /**
     * Request
     *
     * @var \phpOMS\Message\Http\Request
     * @since 1.0.0
     */
    protected $request = null;

    /**
     * Request
     *
     * @var \phpOMS\Message\Http\Response
     * @since 1.0.0
     */
    protected $response = null;

    /**
     * @return \phpOMS\Message\Http\Request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param \phpOMS\Message\Http\Request $request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return \phpOMS\Message\Http\Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param \phpOMS\Message\Http\Response $response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
