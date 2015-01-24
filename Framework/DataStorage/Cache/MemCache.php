<?php
namespace Framework\DataStorage\Cache;

/**
 * Memcache class
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
class MemCache implements \Framework\DataStorage\Cache\CacheInterface
{
    /**
     * Memcache instance
     *
     * @var \Memcache
     * @since 1.0.0
     */
    private $memc = null;

    /**
     * Only cache if data is larger than threshold (0-100)
     *
     * @var int
     * @since 1.0.0
     */
    private $threshold = 10;

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        $this->memc = new Memcache();
    }

    /**
     * Adding server to server pool
     *
     * @param mixed $data Server data array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addServer($data)
    {
        $this->memc->addServer($data['host'], $data['port'], $data['timeout']);
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value, $type = null, $expire = 2592000)
    {
        $this->memc->set($key, $value, false, $expire);
    }

    /**
     * {@inheritdoc}
     */
    public function add($key, $value, $type = null, $expire = 2592000)
    {
        return $this->memc->add($key, $value, false, $expire);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $type = null)
    {
        return $this->memc->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key, $type = null)
    {
        $this->memc->delete($key);
    }

    /**
     * {@inheritdoc}
     */
    public function flush($type = null)
    {
        $this->memc->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function replace($key, $value, $type = null, $expire = 2592000)
    {
        $this->memc->replace($key, $value, false, $expire);
    }

    /**
     * {@inheritdoc}
     */
    public function stats()
    {
        return $this->memc->getExtendedStats();
    }

    /**
     * {@inheritdoc}
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * Closing cache
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function close()
    {
        if($this->memc !== null) {
            $this->memc->close();
            $this->memc = null;
        }
    }

    /**
     * Destructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __destruct()
    {
        $this->close();
    }
}