<?php
namespace Modules\Accounting {
    /**
     * DebitorAccount class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Modules\Accounting
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class DebitorAccount extends \Modules\Accounting\PersonalAccount
    {
        public function __construct()
        {
        }

        public function getDSO()
        {
        }

        public function getDefault()
        {
        }

        public function getNetReceivable()
        {
        }
    }
}