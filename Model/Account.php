<?php
namespace Model;

class Account {
    /**
     * Database connection
     *
     * @var \phpOMs\DataStorage\Database\Connection\Connection
     * @since 1.0.0
     */
    private $connection = null;

    /**
     * Session manager
     *
     * @var \phpOMS\DataStorage\Session\SessionInterface
     * @since 1.0.0
     */
    private $sessionManager = null;

    /**
     * Cache manager
     *
     * @var \phpOMS\DataStorage\Cache\Cache
     * @since 1.0.0
     */
    private $cacheManager = null;

    /**
     * Localization
     *
     * @var \phpOMS\Localization\Localization
     * @since 1.0.0
     */
    private $l11n = null;

    /**
     * Account id
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Constructor
     *
     * @param \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $connection Database connection
     * @param \phpOMS\DataStorage\Session\SessionInterface $sessionManager Session manager
     * @param \phpOMS\DataStorage\Cache\Cache $cacheManager Cache manager
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($connection, $sessionManager, $cacheManager) {
        $this->connection = $connection;
        $this->sessionManager = $sessionManager;
        $this->cacheManager = $cacheManager;

        $this->l11n = new \phpOMS\Localization\Localization();
    }

    /**
     * Authenticate account
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function authenticate() {
        $this->id = (new \phpOMS\Auth\Auth($this->connection, $this->sessionManager))->authenticate();
    }

    /**
     * Get localization
     *
     * @return \phpOMS\Localization\Localization
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getL11n() {
        return $this->l11n;
    }

    /**
     * Get account id
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId() {
        return $this->id;
    }
}
