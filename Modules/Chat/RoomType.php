<?php
namespace Modules\Chat;

/**
 * Room type enum
 *
 * PHP Version 5.4
 *
 * @category   Chat
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class RoomType extends \phpOMS\Datatypes\Enum
{

    const PUBLIC_CHAT  = 0;

    const PRIVATE_CHAT = 1;

    const TEMP_CHAT    = 2;

}