<?php
namespace Framework\DataStorage\Database;
    /**
     * Database status enum
     *
     * Possible database connection status
     *
     * PHP Version 5.4
     *
     * @category   Framework
     * @package    Framework\DataStorage\Database
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class DatabaseStatus extends \Framework\Datatypes\Enum
    {
        const OK               = 0; /* Database connection successful */
        const MISSING_DATABASE = 1; /* Couldn't find database */
        const MISSING_TABLE    = 2; /* One of the core tables couldn't be found */
        const FAILURE          = 3; /* Unknown failure */
        const READONLY         = 4; /* Database connection is in readonly (but ok) */

    }