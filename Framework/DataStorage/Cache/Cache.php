<?php
namespace Framework\DataStorage\Cache;

/**
 * Cache class
 *
 * Responsible for caching scalar data types and arrays.
 * Caching HTML output and objects coming soon/is planned.
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Framework\DataStorage\Cache
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Cache implements \Framework\DataStorage\Cache\CacheInterface, \Framework\Config\OptionsInterface
{
    use \Framework\Config\OptionsTrait;

    /**
     * MemCache instance
     *
     * @var \Framework\DataStorage\Cache\MemCache
     * @since 1.0.0
     */
    private $memc = null;

    /**
     * FileCache instance
     *
     * @var \Framework\DataStorage\Cache\FileCache
     * @since 1.0.0
     */
    private $filec = null;

    /**
     * Application instance
     *
     * @var \Framework\WebApplication
     * @since 1.0.0
     */
    private $app = null;

    /**
     * Constructor
     *
     * @param \Framework\ApplicationAbstract $app Application instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Requesting caching instance
     *
     * @param \Framework\DataStorage\Cache\CacheStatus $type Cache to request
     *
     * @return \Framework\DataStorage\Cache\MemCache|\Framework\DataStorage\Cache\FileCache|null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function get_instance($type = null)
    {
        if(($type === null || $type === \Framework\DataStorage\Cache\CacheStatus::MEMCACHE) && $this->memc !== null) {
            return $this->memc;
        }

        if(($type === null || $type === \Framework\DataStorage\Cache\CacheStatus::FILECACHE) && $this->filec !== null) {
            return $this->memc;
        }

        return null;
    }

    /**
     * Init cache
     *
     * @param mixed $options Options used to initialize the different caching types
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function init($options = null)
    {
        if($options === null) {
            /* This is costing me 1ms, maybe init settings first cause i'm making another settings call later on -> same call 2 times */
            $sth = $this->app->dbPool->get('core')->con->prepare('SELECT `content` FROM `' . $this->app->dbPool->get('core')->prefix . 'settings` WHERE `id` = 1000000015');
            $sth->execute();
            $cache_data = $sth->fetchAll();

            $this->setOption('cache:type', (int) $cache_data[0][0]);
        } else {
            $this->options = $options;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function update()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value, $type = null, $expire = 2592000)
    {
        $this->get_instance($type)->set($key, $value, $type = null, $expire);
    }

    /**
     * {@inheritdoc}
     */
    public function add($key, $value, $type = null, $expire = 2592000)
    {
        $this->get_instance($type)->add($key, $value, $type = null, $expire);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $type = null)
    {
        return $this->get_instance($type)->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key, $type = null)
    {
        $this->get_instance($type)->delete($key);
    }

    /**
     * {@inheritdoc}
     */
    public function flush($type = null)
    {
        if($type === null) {
            $this->filec->flush();
            $this->memc->flush();
        } elseif($type === \Framework\DataStorage\Cache\CacheStatus::MEMCACHE) {
            $this->memc->flush();
        } elseif($type === \Framework\DataStorage\Cache\CacheStatus::FILECACHE) {
            $this->filec->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function replace($key, $value, $type = null)
    {
        $this->get_instance($type)->replace($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function stats()
    {
        $stats = [];

        if($this->memc !== null) {
            $stats['memc'] = $this->memc->stats();
        }

        if($this->filec !== null) {
            $stats['filec'] = $this->filec->stats();
        }

        return $stats;
    }

    /**
     * {@inheritdoc}
     */
    public function getThreshold()
    {
        $threshold = [];

        if($this->memc !== null) {
            $threshold['memc'] = $this->memc->getThreshold();
        }

        if($this->filec !== null) {
            $threshold['filec'] = $this->filec->getThreshold();
        }

        return $threshold;
    }
}
