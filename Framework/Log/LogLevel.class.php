<?php
namespace Framework\Log {
	/**
     * Log level enum
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class LogLevel extends \Framework\Datatypes\Enum {
        const INFO = 0;
        const DEBUG = 1;
        const WARNING = 2;
        const ERROR = 3;
        const FATAL = 4;
    }
}