<?php
namespace Framework\DataStorage\Database\Objects\User {
    /**
     * User type enum
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
    abstract class UserType extends \Framework\Datatypes\Enum {
        const PERSON       = 0;
        const ORGANIZATION = 1;
        const COMPANY      = 2;
        const GROUP        = 3;
    }
}