<?php
namespace Modules\Accounting\Models;

/**
 * Account interface
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
interface AccountInterface
{
    /**
     * Get all groups
     *
     * This function gets all groups in a range
     *
     * @return float
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getBalance();

    /**
     * Close out account
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function closeOut();
}