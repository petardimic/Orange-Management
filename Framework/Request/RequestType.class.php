<?php
namespace Framework\Request {
    /**
     * Request type enum
     *
     * Request types that are supported by this application. Especially useful for restful requests and the API.
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
    abstract class RequestType extends \Framework\Datatypes\Enum
    {
        const GET = 'GET'; /* GET */
        const POST = 'POST'; /* POST */
        const PUT = 'PUT'; /* PUT */
        const DELETE = 'DELETE'; /* DELETE */
        const HEAD = 'HEAD'; /* HEAD */
        const TRACE = 'TRACE'; /* TRACE */
    }
}