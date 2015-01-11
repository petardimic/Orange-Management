<?php
namespace Modules\Accounting {
    /**
     * Account type enum
     *
     * PHP Version 5.4
     *
     * @category   DataStorage
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class AccountType extends \Framework\Datatypes\Enum
    {
        const IMPERSONAL = 0;
        const PERSONAL   = 1;
        const CREDITOR   = 2;
        const DEBITOR    = 3;
    }
}