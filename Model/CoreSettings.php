<?php
namespace OMS/Model;

/**
 * Core settings class
 *
 * This is used in order to manage global Framework and Module settings
 *
 * PHP Version 5.4
 *
 * @category   Model
 * @package    Model
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 *
 * @todo: maybe move this \Web
 */
class CoreSettings extends \phpOMS\Config\SettingsAbstract
{
    /**
     * Settings table
     *
     * @var string
     * @since 1.0.0
     */
    private $table = 'settings';

    /**
     * Columns
     *
     * @var string[]
     * @since 1.0.0
     */
    protected $columns = [
        'id'
    ];

    /**
     * Database connection instance
     *
     * @var \phpOMS\DataStorage\Database\Connection\Connection
     * @since 1.0.0
     */
    private $connection = null;

    /**
     * Constructor
     *
     * @param \phpOMS\DataStorage\Database\Connection\Connection $connection Database conection
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }
}
