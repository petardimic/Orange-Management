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
class Account
{

    /**
     * Id
     *
     * @var int
     * @since 1.0.0
     */
    protected $id = 0;

    /**
     * Names
     *
     * @var string[]
     * @since 1.0.0
     */
    protected $name = null;

    /**
     * Ip
     *
     * Used in order to make sure ips don't change
     *
     * @var string
     * @since 1.0.0
     */
    protected $origin = null;

    /**
     * Login
     *
     * @var string
     * @since 1.0.0
     */
    protected $login = null;

    /**
     * Permissions
     *
     * @var array
     * @since 1.0.0
     */
    protected $permissions = [];

    /**
     * Groups
     *
     * @var int[]
     * @since 1.0.0
     */
    protected $groups = [];

    /**
     * Account type
     *
     * @var \phpOMS\Account\AccountType
     * @since 1.0.0
     */
    protected $type = \phpOMS\Account\AccountType::USER;

    /**
     * Localization
     *
     * @var \phpOMS\Localization\Localization
     * @since 1.0.0
     */
    protected $l11n = null;

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
     * Get account id
     *
     * @return int Account id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get localization
     *
     * @return \phpOMS\Localization\Localization
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getL11n() {
        return $this->l11n;
    }

    /**
     * Set localization
     *
     * @param \phpOMS\Localization\Localization $l11n Localization
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setL11n($l11n) {
        $this->l11n = $l11n;
    }
}
