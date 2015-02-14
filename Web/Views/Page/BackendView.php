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
class BackendView extends \Framework\Views\ViewAbstract
{
    /**
     * Request
     *
     * @var \Framework\Message\Http\Request
     * @since 1.0.0
     */
    protected $request = null;

    /**
     * Request
     *
     * @var \Framework\Message\Http\Response
     * @since 1.0.0
     */
    protected $response = null;

    /**
     * @return \Framework\Message\Http\Request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param \Framework\Message\Http\Request $request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Framework\Message\Http\Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param \Framework\Message\Http\Response $response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
