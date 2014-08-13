<?php
namespace Framework\DataStorage\Database\Objects\User {
    /**
     * User status enum
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
    abstract class UserStatus extends \Framework\Datatypes\Enum {
        const ACTIVE = 0;
        const INACTIVE = 1;
        const BANNED = 2;
        const TIMEOUTED = 3;
    }
}