<?php
namespace Framework\Auth {
    /**
     * Login return types enum
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
    abstract class LoginReturnType extends \Framework\Datatypes\Enum {
        const OK                   = 0;
        const FAILURE              = 1;
        const WRONG_PASSWORD       = 2;
        const WRONG_USERNAME       = 3;
        const WRONG_PERMISSION     = 4;
        const NOT_ACTIVATED        = 5;
        const WRONG_INPUT_EXCEEDED = 6;
        const TIMEOUTED            = 7;
        const BANNED               = 8;
        const INACTIVE             = 9;
    }
}