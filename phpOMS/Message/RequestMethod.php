<?php
namespace phpOMS\Message;

/**
 * Request method enum
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
abstract class RequestMethod extends \phpOMS\Datatypes\Enum
{
    const GET = 'GET';    /* GET */
    const POST = 'POST';   /* POST */
    const PUT = 'PUT';    /* PUT */
    const DELETE = 'DELETE'; /* DELETE */
    const HEAD = 'HEAD';   /* HEAD */
    const TRACE = 'TRACE';  /* TRACE */
}