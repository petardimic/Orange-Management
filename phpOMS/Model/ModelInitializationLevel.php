<?php
namespace phpOMS\Model;

/**
 * Initialization detail level enum
 *
 * This is used in order to define how many details a ORM should initialize
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Model
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class InitializationLevel extends \phpOMS\Datatypes\Enum
{
    const MINIMUM = 0;
    const MEDIUM = 1;
    const MAXIMUM = 2;
}
