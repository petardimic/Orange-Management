<?php
namespace Framework\Request;
    /**
     * Request source enum
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
    abstract class RequestSource extends \Framework\Datatypes\Enum
    {
        const WEB = 0; /* This is a http request */
        const CONSOLE = 1; /* Request is a console command */
        const SOCKET = 2; /* Request through socket connection */

    }