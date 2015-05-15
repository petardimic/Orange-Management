<?php
namespace Modules\Navigation\Models;

/**
 * Navigation class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Navigation
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Navigation
{

// region Class Fields
    /**
     * Navigation array
     *
     * Array of all navigation elements sorted by type->parent->id
     *
     * @var array
     * @since 1.0.0
     */
    public $nav = [];

    /**
     * Navigation array
     *
     * Array of all navigation elements by id
     *
     * @var array
     * @since 1.0.0
     */
    public $nid = null;

    /**
     * Parent links of the current page
     *
     * @var array
     * @since 1.0.0
     */
    public $nav_parents = null;

    /**
     * Singleton instance
     *
     * @var \Modules\Navigation\Models\Navigation
     * @since 1.0.0
     */
    private static $instance = null;

    /**
     * Database pool
     *
     * @var \phpOMS\DataStorage\Database\Pool
     * @since 1.0.0
     */
    private $dbPool = null;
// endregion

    /**
     * Constructor
     *
     * @param string[]                          $request Request hashes
     * @param \phpOMS\DataStorage\Database\Pool $dbPool  Database pool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function __construct($request, $dbPool)
    {
        $this->dbPool = $dbPool;
        $this->load($request);
    }

    /**
     * Load navigation based on request
     *
     * @param string[] $request Request hashes
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function load($request)
    {
        if(!$this->nav) {
            $temp_nav  = null;
            $this->nav = [];

            $uri_hash = $request;
            $uri_pdo = '';

            $i = 1;
            foreach($uri_hash as $hash) {
                $uri_pdo .= ':pid' . $i . ',';
                $i++;
            }

            $uri_pdo = rtrim($uri_pdo, ',');

            $sth = $this->dbPool->get('core')->con->prepare('SELECT * FROM `' . $this->dbPool->get('core')->prefix . 'nav` WHERE `nav_pid` IN('.$uri_pdo.') ORDER BY `nav_order` ASC');

            $i = 1;
            foreach($uri_hash as $hash) {
                $sth->bindValue(':pid' . $i, $hash, \PDO::PARAM_STR);
                $i++;
            }

            $sth->execute();
            $temp_nav = $sth->fetchAll();

            foreach($temp_nav as $link) {
                $this->nav[$link['nav_type']][$link['nav_subtype']][$link['nav_id']] = $link;
            }
        }
    }

    /**
     * Get instance
     *
     * @param string[]                          $request Request hashes
     * @param \phpOMS\DataStorage\Database\Pool $dbPool  Database pool
     *
     * @return \Modules\Navigation\Models\Navigation
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getInstance($request = null, $dbPool = null)
    {
        if(!isset(self::$instance)) {
            self::$instance = new self($request, $dbPool);
        }

        return self::$instance;
    }

    /**
     * Overwriting clone in order to maintain singleton pattern
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __clone()
    {
    }
}