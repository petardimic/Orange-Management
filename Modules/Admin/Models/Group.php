<?php
namespace Modules\Admin\Models;

class Group
{
    /**
     * Database connection
     *
     * @var \phpOMs\DataStorage\Database\Connection\ConnectionAbstract
     * @since 1.0.0
     */
    private $connection = null;

    /**
     * Cache manager
     *
     * @var \phpOMS\DataStorage\Cache\Cache
     * @since 1.0.0
     */
    private $cacheManager = null;

    /**
     * Account id
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Account name
     *
     * @var string
     * @since 1.0.0
     */
    private $name = '';

    /**
     * Account name
     *
     * @var string
     * @since 1.0.0
     */
    private $description = '';

    /**
     * Multition cache
     *
     * @var \Model\Account[]
     * @since 1.0.0
     */
    private static $instances = [];

    /**
     * Multition constructor
     *
     * @param int                                                        $id           Account id
     * @param \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $connection   Database connection
     * @param \phpOMS\DataStorage\Cache\Cache                            $cacheManager Cache manager
     *
     * @return \Model\Account
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getInstance($id, $connection, $cacheManager)
    {
        if(!isset(self::$instances[$id])) {
            self::$instances[$id] = new self($id, $connection, $cacheManager);
        }

        return self::$instances[$id];
    }

    /**
     * Constructor
     *
     * @param int                                                        $id           Account id
     * @param \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $connection   Database connection
     * @param \phpOMS\DataStorage\Cache\Cache                            $cacheManager Cache manager
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($id, $connection, $cacheManager)
    {
        $this->id           = $id;
        $this->connection   = $connection;
        $this->cacheManager = $cacheManager;

        $this->l11n = new \phpOMS\Localization\Localization();
    }

    /**
     * Get account id
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId()
    {
        return $this->id;
    }
}
