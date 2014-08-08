<?php
require_once __DIR__ . '/../../core/Database.class.php';
require_once __DIR__ . '/../../core/Cache.class.php';
require_once __DIR__ . '/../../core/Account.class.php';

class UserTest extends PHPUnit_Framework_TestCase {
    /**
     * @var \Framework\Core\Database\Database
     */
    protected $db;

    /**
     * @var \Framework\Core\Cache
     */
    protected $cache;

    /**
     * @var \Framework\Core\User
     */
    protected $user;

    /**
     * Setting up everything required for this test
     *
     * @since 1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function setUp() {
        /**
         * @var array $DBDATA
         */
        require __DIR__ . '/../../oms-config.php';

        $this->db    = new \Framework\Core\Database\Database($DBDATA);
        $this->cache = new \Framework\Core\Cache($this->db);
        $this->user  = new \Framework\Core\User($this->db, $this->cache);
    }

    /**
     * Checking if the construction was alright
     *
     * @since 1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function test_Init() {
        $this->assertNotNull($this->db);
        $this->assertNotNull($this->cache);
        $this->assertNotNull($this->user);
    }

    /**
     * Checking if the initialization is as expected
     *
     * @since 1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function test_DB_Init() {
        $this->assertNotNull($this->db->con, "Couldn't connect to DB.");
    }

    /**
     * Checking if the initialization is as expected
     *
     * @since 1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function test_Cache_Init() {
        $this->assertFalse($this->cache->active);
        $this->assertEquals(1, $this->cache->type);
    }

    /**
     * Checking if the initialization is as expected
     *
     * @since 1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function test_User_Init() {

    }
}