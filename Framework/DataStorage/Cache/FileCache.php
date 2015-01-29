<?php
namespace Framework\DataStorage\Cache;

/**
 * Filecache class
 *
 * PHP Version 5.6
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
class FileCache implements \Framework\DataStorage\Cache\CacheInterface
{
    /**
     * Only cache if data is larger than threshold (0-100)
     *
     * @var int
     * @since 1.0.0
     */
    private $threshold = 50;

    /**
     * Cache path
     *
     * @var string
     * @since 1.0.0
     */
    private static $cachePath = __DIR__ . '/../../../Cache';

    /**
     * {@inheritdoc}
     */
    public function set($key, $value, $type = null, $expire = 2592000)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function add($key, $value, $type = null, $expire = 2592000)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $type = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key, $type = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function flush($type = null)
    {
        array_map('unlink', glob(self::$cachePath . '/*'));
    }

    /**
     * {@inheritdoc}
     */
    public function replace($key, $value, $type = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function stats()
    {
        $stats          = [];
        $stats['count'] = \Framework\System\FileSystem::getFileCount(self::$cachePath);

        // size, avg. last change compared to now

        return $stats;
    }

    /**
     * {@inheritdoc}
     */
    public function getThreshold()
    {
        return $this->threshold;
    }
}