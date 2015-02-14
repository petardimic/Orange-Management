<?php
namespace Framework\DataStorage\Session;

/**
 * Http session class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Framework\DataStorage\Cache
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class HttpSession implements \Framework\DataStorage\Session\SessionInterface
{
    private $sessionData = [];

    /**
     * Session ID
     *
     * @var string|int
     * @since 1.0.0
     */
    private $sid = null;

    /**
     * Constructor
     *
     * @param string|int|bool $sid Session id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($sid = false)
    {
        if($sid !== false) {
            session_id($sid);
        }

        session_start();
        $this->sessionData = $_SESSION;

        $this->sid = session_id();
        session_write_close();
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        if(isset($this->sessionData[$key])) {
            return $this->sessionData[$key];
        } else {
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value, $overwrite = true)
    {
        $this->sessionData[$key] = $value;
    }

    public function save() {
        session_id($this->sid);
        session_start();
        $_SESSION = $this->sessionData;
        session_write_close();
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        if(isset($this->sessionData[$key])) {
            unset($this->sessionData[$key]);
        }
    }
}