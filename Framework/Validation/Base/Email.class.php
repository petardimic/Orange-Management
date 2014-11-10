<?php
namespace Framework\Validation {
    /**
     * Validator abstract
     *
     * PHP Version 5.4
     *
     * @category   Validation
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class Email extends \Framework\Validation\ValidatorAbstract {
    	private function __construct() {
    	}

    	public static is_valid($value) {
    		return filter_var($val, FILTER_VALIDATE_EMAIL);
    	}
    }
}