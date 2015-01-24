<?php
namespace Modules\Messages;

/**
 * Email interface
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Messages
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface Email
{
    public function connect($host, $port, $user, $password);

    public function getListNew();

    public function getListAll();

    public function getMessage();

    public function removeMessage();

    public function setStatus();
}