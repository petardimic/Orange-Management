<?php
namespace Model\Message;

/**
 * NotifyType class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Model\Message
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class NotifyType extends \phpOMS\Datatypes\Enum
{

    const BINARY  = 0;

    const INFO    = 1;

    const WARNING = 2;

    const ERROR   = 3;

    const FATAL   = 4;

}
