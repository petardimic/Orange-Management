<?php
namespace phpOMS\Account;

/**
 * Account manager class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Asset
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class AccountManager
{

    /**
     * Accounts
     *
     * @var int[]
     * @since 1.0.0
     */
    private $accounts = [];

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
    }

    /**
     * Get account
     *
     * @param int $id Account id
     *
     * @return \phpOMS\Account\Account
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function get($id)
    {
        if(isset($this->accounts[$id])) {
            return $this->accounts[$id];
        }

        return null;
    }

    /**
     * Get account
     *
     * @param \phpOMS\Account\Account $account Account
     *
     * @return int Account id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function set($account)
    {
        if(!isset($this->accounts[$account->getId()])) {
            $this->accounts[$account->getId()] = $account;

            return $account->getId();
        }

        return 0;
    }
}