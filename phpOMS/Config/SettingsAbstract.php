<?php
namespace phpOMS\Config;

/**
 * Settings class
 *
 * Responsible for providing a database/cache bound settings manger
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
 */
abstract class SettingsAbstract implements \phpOMS\Config\OptionsInterface {
    use \phpOMS\Config\OptionsTrait;

    /**
     * Cache manager (pool)
     *
     * @var \phpOMS\DataStorage\Cache\Cache
     * @since 1.0.0
     */
    private $cache = null;

    /**
     * Database connection instance
     *
     * @var \phpOMS\DataStorage\Database\Connection\Connection
     * @since 1.0.0
     */
    private $connection = null;

    /**
     * Settings table
     *
     * @var string
     * @since 1.0.0
     */
    protected $table = null;

    /**
     * Columns to identify the value
     *
     * @var string[]
     * @since 1.0.0
     */
    protected $columns = [
        'id'
    ];

    /**
     * Field where the actual value is stored
     *
     * @var string
     * @since 1.0.0
     */
    protected $valueField = 'option';

    /**
     * Get option by key
     *
     * @param string[] $columns Column values for filtering
     *
     * @return mixed Option value
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function get($columns) {
        $key = md5(json_encode($columns));

        if(!$this->exists($key)) {

        }

        return $this->getOption($key);
    }

    /**
     * Get option by key
     *
     * @param string[] $columns Column values for filtering
     * @param string[] $value Value to insert
     *
     * @return mixed Option value
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function set($columns, $value, $overwrite = true, $cachable = true, $store = false) {
        $key = md5(json_encode($columns));

    }
}
