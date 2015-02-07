<?php
namespace Framework\Module;

/**
 * Module call type
 *
 * This type indeicates what kind of request response is generated
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Framework\DataStorage\Database
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class CallType extends \Framework\Datatypes\Enum
{
    const WEB = 0; /* Web request */
}