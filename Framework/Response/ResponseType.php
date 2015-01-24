<?php
namespace Framework\Http\Response;

/**
 * Request type enum
 *
 * PHP Version 5.4
 *
 * @category   Http
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class ResponseType extends \Framework\Datatypes\Enum
{
    const HTTP    = 0; /* HTTP */
    const JSON    = 1; /* JSON */
    const SOCKET  = 2; /* Socket */
    const CONSOLE = 3; /* Console */

}