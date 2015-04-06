<?php
namespace phpOMS\Config;

/**
 * Settings class
 *
 * Responsible for all application and module configurations.
 * This class can load and save settings based on their ids.
 * Creating new settings is not possible, this has to be done during the module installation.
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Config
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 *
 * @todo: maybe move this to account model
 */
class AccountSettings extends \phpOMS\Config\SettingsAbstract
{
    /**
     * Settings table
     *
     * @var string
     * @since 1.0.0
     */
    protected $table = 'account_settings';

    /**
     * Columns
     *
     * @var string[]
     * @since 1.0.0
     */
    protected $columns = [
        'account',
        'origin'
    ];

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
