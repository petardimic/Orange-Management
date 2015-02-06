<?php
// TODO: Maybe remove this class entirely
namespace Framework\Config;

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
 * @package    Framework\Settings
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Settings
{
    /**
     * Config
     *
     * @var array
     * @since 1.0.0
     */
    public $config = [];

    /**
     * FileCache instance
     *
     * @var \Framework\DataStorage\Database\Pool
     * @since 1.0.0
     */
    private $dbPool = null;

    /**
     * Constructor
     *
     * @param \Framework\DataStorage\Database\Pool $dbPool Database pool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($dbPool)
    {
        $this->dbPool = $dbPool;
    }

    /**
     * Loads settings
     *
     * @param array $ids Setting IDs
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function loadSettings($ids)
    {
        foreach($ids as $id) {
            if(isset($this->config[$id])) {
                unset($ids[$id]);
            }
        }

        // TODO: implement cache if cache is initialized
        if(!empty($ids)) {
            $sth = $this->dbPool->get('core')->con->prepare('SELECT `id`, `content` FROM `' . $this->dbPool->get('core')->prefix . 'settings` WHERE `id` IN (' . implode(',', $ids) . ')');
            $sth->execute();
            $cfgs = $sth->fetchAll(\PDO::FETCH_KEY_PAIR);
            $this->config += $cfgs;
        }
    }

    /**
     * Change settings
     *
     * @param array $settings Settings to set
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setSettings($settings)
    {
        $this->config += $settings;

        /* TODO: change this + implement cache */
        foreach($settings as $key => $value) {
            $sth = $this->dbPool->get('core')->con->prepare('UPDATE `' . $this->dbPool->get('core')->prefix . 'settings` SET `content` = \'' . $value . '\' WHERE `id` = ' . $key);
            $sth->execute();
        }
    }
}
