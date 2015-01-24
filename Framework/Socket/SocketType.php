<?php
namespace Framework\Socket {
    /**
     * Socket type enum
     *
     * PHP Version 5.4
     *
     * @category   Framework
     * @package    Framework\Socket
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class SocketType extends \Framework\Datatypes\Enum
    {
        const SERVER = 0; /* Server socket */
        const CLIENT = 1; /* Client socket */
    }
}