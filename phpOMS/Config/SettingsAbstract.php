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
abstract class SettingsAbstract implements \phpOMS\Config\OptionsInterface
{
    use \phpOMS\Config\OptionsTrait;

// region Class Fields
    /**
     * Cache manager (pool)
     *
     * @var \phpOMS\DataStorage\Cache\Cache
     * @since 1.0.0
     */
    protected $cache = null;

    /**
     * Database connection instance
     *
     * @var \phpOMS\DataStorage\Database\Connection\ConnectionAbstract
     * @since 1.0.0
     */
    protected $connection = null;

    /**
     * Settings table
     *
     * @var string
     * @since 1.0.0
     */
    static protected $table = null;

    /**
     * Columns to identify the value
     *
     * @var string[]
     * @since 1.0.0
     */
    static protected $columns = [
        'id'
    ];

    /**
     * Field where the actual value is stored
     *
     * @var string
     * @since 1.0.0
     */
    protected $valueField = 'option';

// endregion

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
    public function get($columns)
    {
        //$key = md5(json_encode($columns));

        $options = false;

        switch($this->connection->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $sth = $this->connection->con->prepare(
                    'SELECT `' . static::$columns[0] . '`, `settings_content` FROM `' . $this->connection->prefix . static::$table . '` WHERE '
                    . '`' . $this->connection->prefix . static::$table . '`.`' . static::$columns[0] . '` IN ('
                    . implode(',', $columns) . ')'
                );
                $sth->execute();

                $options = $sth->fetchAll(\PDO::FETCH_KEY_PAIR);
                $this->setOptions($options);
                break;
        }

        return $options;
    }

    /**
     * Get option by key
     *
     * @param string[] $columns   Column values for filtering
     * @param string[] $value     Value to insert
     * @param boolean  $overwrite Overwrite existing settings
     * @param boolean  $cachable  Cache this setting
     * @param boolean  $store     Save this Setting immediately to database
     *
     * @return mixed Option value
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function set($columns, $value, $overwrite = true, $cachable = true, $store = false)
    {
        $key = md5(json_encode($columns));
    }
}
