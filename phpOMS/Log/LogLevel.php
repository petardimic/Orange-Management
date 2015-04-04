<?php
/* This logging class will not be in the release or dev version!!!! Use a logging library/framework for that */
namespace phpOMS\Log;

/**
 * Log level enum
 *
 * PHP Version 5.4
 *
 * @category   Log
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class LogLevel extends \phpOMS\Datatypes\Enum
{
    const DEBUG = 0; /* Everything with higher priority gets logged */
    const INFO = 1; /* Everything with higher priority gets logged */
    const WARNING = 2; /* Everything with higher priority gets logged */
    const ERROR = 3; /* Everything with higher priority gets logged */
    const FATAL = 4; /* Only this gets logged */
}
