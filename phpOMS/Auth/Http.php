<?php
namespace phpOMS\Auth;

/**
 * Auth class
 *
 * Responsible for authenticating and initializing the connection
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Auth
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Http implements \phpOMS\Auth\AuthInterface, \phpOMS\Config\OptionsInterface
{
    use \phpOMS\Config\OptionsTrait;

    /**
     * Session instance
     *
     * @var \phpOMS\DataStorage\Session\SessionInterface
     * @since 1.0.0
     */
    private $session = null;

    /**
     * Database pool instance
     *
     * @var \phpOMS\DataStorage\Database\Pool
     * @since 1.0.0
     */
    private $dbPool = null;

    /**
     * Constructor
     *
     * @param \phpOMS\DataStorage\Database\Pool            $dbPool  Database pool
     * @param \phpOMS\DataStorage\Session\SessionInterface $session Session
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($dbPool, $session)
    {
        $this->dbPool = $dbPool;
        $this->session = $session;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate()
    {
        $uid = $this->session->get('UID');

        if($uid === null) {
            $uid = -1;
        }

        return \phpOMS\Models\User\User::getInstance($uid, $this->dbPool, true);
    }

    /**
     * {@inheritdoc}
     */
    public function login($login, $password)
    {
        try {
            $result = null;

            switch($this->dbPool->get('core')->getType()) {
                case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:

                    $sth = $this->dbPool->get('core')->con->prepare(
                        'SELECT
                            `' . $this->dbPool->get('core')->prefix . 'accounts_data`.*,
                            `' . $this->dbPool->get('core')->prefix . 'accounts`.*
                        FROM
                            `' . $this->dbPool->get('core')->prefix . 'accounts_data`
                        LEFT JOIN
                            `' . $this->dbPool->get('core')->prefix . 'accounts`
                        ON
                            `' . $this->dbPool->get('core')->prefix . 'accounts_data`.`account` = `' . $this->dbPool->get('core')->prefix . 'accounts_`.`id`
                        WHERE
                            `' . $this->dbPool->get('core')->prefix . 'accounts_data`.`login` = :login'
                    );
                    $sth->bindValue(':login', $login, \PDO::PARAM_STR);
                    $sth->execute();

                    $result = $sth->fetchAll()[0];
                    break;
            }

            // TODO: check if user is allowed to login on THIS page (backend|frontend|etc...)

            if($result === null) {
                return \phpOMS\Auth\LoginReturnType::WRONG_USERNAME;
            }

            if($result['tries'] <= 0) {
                return \phpOMS\Auth\LoginReturnType::WRONG_INPUT_EXCEEDED;
            }

            if(password_verify($password, $result['password'])) {
                if($result['status'] === \phpOMS\Auth\LoginReturnType::OK) {
                    $this->session->set('UID', $result['account']);
                }

                return $result['status'];
            }

            return \phpOMS\Auth\LoginReturnType::WRONG_PASSWORD;
        } catch(\Exception $e) {
            return \phpOMS\Auth\LoginReturnType::FAILURE;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function logout($uid)
    {
        // TODO: logout other users? If admin wants to kick a user for updates etc.
        $this->session->remove('UID');
    }
}