<?php
namespace Framework\DataStorage\Database {
    /**
     * Database type enum
     *
     * Database types that are supported by the application
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
    abstract class DatabaseType extends \Framework\Datatypes\Enum {
        const MYSQL = 0; /* MYSQL */
        const SQLITE = 1; /* SQLITE */
    }
}