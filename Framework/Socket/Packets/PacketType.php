<?php
namespace Framework\Socket\Packets;
    /**
     * Packet type enum
     *
     * PHP Version 5.4
     *
     * @category   Framework
     * @package    Framework\Socket\Packets
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class PacketType extends \Framework\Datatypes\Enum
    {
        const CONNECT    = 0; /* Client connection (server/sender) */
        const DISCONNECT = 1; /* Client disconnection (server/sender) */
        const KICK       = 2; /* Kick (server/client/sender) */
        const PING       = 3; /* Ping (server/sender) */
        const HELP       = 4; /* Help (server/sender) */
        const RESTART    = 5; /* Restart server (server/all clients/client) */
        const MSG        = 6; /* Message (server/sender/client/all clients?) */
        const LOGIN      = 7; /* Login (server/sender) */
        const LOGOUT     = 8; /* Logout (server/sender) */
        const ACCMODIFY  = 9; /* Account modification (server/sender (admin)/user) */
        const MODULE     = 999999999; /* Module packet ??? */

    }