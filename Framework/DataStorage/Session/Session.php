<?php
namespace Framework\DataStorage\Session;

/**
 * Session class
 *
 * PHP Version 5.4
 *
 * @category   DataStorage
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Session
{
    public function __construct()
    {
    }

    public function init()
    {
        session_start();
        // TODO: get session data
        session_write_close();
    }

    public function getValue($id)
    {
        return null;
    }

    public function setValue($id, $value)
    {
    }

    public function deleteValue($id)
    {
    }

    public function close()
    {
        session_start();
        // TODO write session data
        session_write_close();
    }
}