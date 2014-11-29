<?php
namespace Modules\Accounting {
    /**
     * Account abstraction class
     *
     * PHP Version 5.4
     *
     * @category   Module
     * @package    Accounting
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class AccountAbstract implements \Modules\Accounting\AccountInterface {
        protected $id = 0;

        protected $type = null;

        public function __construct($id) {
            $this->id = $id;
        }
    }
}