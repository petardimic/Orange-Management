<?php
namespace Framework\Auth;

/**
 * Auth interface
 *
 * Responsible for authenticating and initializing the connection
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Framework\Auth
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface AuthInterface
{
    /**
     * Authenticates user
     *
     * @return \Framework\Models\User\User
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function authenticate();

    /**
     * Login user
     *
     * @param string $login    Username
     * @param string $password Password
     *
     * @return int Login code
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function login($login, $password);

    /**
     * Logout the given user
     *
     * @param int $uid User ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function logout($uid);
}
