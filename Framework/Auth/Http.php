<?php
namespace Framework\Auth;

/**
 * Auth class
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
class Http implements \Framework\Auth\AuthInterface, \Framework\Config\OptionsInterface
{
    use \Framework\Config\OptionsTrait;

    /**
     * Application instance
     *
     * @var \Framework\WebApplication
     * @since 1.0.0
     */
    private $app = null;

    /**
     * Constructor
     *
     * @param \Framework\WebApplication $app Application reference
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate()
    {
        $uid = $this->app->session->get('UID');

        if($uid === null) {
            $uid = -1;
        }

        return \Framework\Object\User\User::getInstance($uid, $this->app, true);
    }

    /**
     * {@inheritdoc}
     */
    public function login($login, $password)
    {
        try {
            $result = null;

            switch($this->app->dbPool->get('core')->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:

                    $sth = $this->app->dbPool->get('core')->con->prepare(
                        'SELECT
                            `' . $this->app->dbPool->get('core')->prefix . 'accounts_data`.*,
                            `' . $this->app->dbPool->get('core')->prefix . 'accounts`.*
                        FROM
                            `' . $this->app->dbPool->get('core')->prefix . 'accounts_data`
                        LEFT JOIN
                            `' . $this->app->dbPool->get('core')->prefix . 'accounts`
                        ON
                            `' . $this->app->dbPool->get('core')->prefix . 'accounts_data`.`account` = `' . $this->app->dbPool->get('core')->prefix . 'accounts_`.`id`
                        WHERE
                            `' . $this->app->dbPool->get('core')->prefix . 'accounts_data`.`login` = :login'
                    );
                    $sth->bindValue(':login', $login, \PDO::PARAM_STR);
                    $sth->execute();

                    $result = $sth->fetchAll()[0];
                    break;
            }

            // TODO: check if user is allowed to login on THIS page (backend|frontend|etc...)

            if($result === null) {
                return \Framework\Auth\LoginReturnType::WRONG_USERNAME;
            }

            if($result['tries'] <= 0) {
                return \Framework\Auth\LoginReturnType::WRONG_INPUT_EXCEEDED;
            }

            if(password_verify($password, $result['password'])) {
                if($result['status'] === \Framework\Auth\LoginReturnType::OK) {
                    $this->app->session->set('UID', $result['account']);
                }

                return $result['status'];
            }

            return \Framework\Auth\LoginReturnType::WRONG_PASSWORD;
        } catch(\Exception $e) {
            return \Framework\Auth\LoginReturnType::FAILURE;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function logout($uid)
    {
        // TODO: logout other users? If admin wants to kick a user for updates etc.
        $this->app->session->remove('UID');
    }
}
