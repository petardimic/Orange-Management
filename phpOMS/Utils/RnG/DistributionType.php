<?php
namespace phpOMS\Utils\RnG;

/**
 * Distribution type enum
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Utils/RnG
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class DistributionType extends \phpOMS\Datatypes\Enum
{
    const UNIFORM = 0;
    const NORMAL  = 1;

}