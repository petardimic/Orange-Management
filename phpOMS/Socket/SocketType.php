<?php
namespace phpOMS\Socket;

/**
 * Socket type enum
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Socket
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class SocketType extends \phpOMS\Datatypes\Enum
{
    const SERVER = 'server'; /* Server socket */
    const CLIENT = 'client'; /* Client socket */
}