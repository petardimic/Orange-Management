<?php
namespace phpOMS\Asset;

/**
 * Asset manager class
 *
 * Responsible for authenticating and initializing the connection
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Asset
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class AssetManager
{

// region Class Fields
    /**
     * Assets
     *
     * @var mixed
     * @since 1.0.0
     */
    private $assets = [];
// endregion

    /**
     * Constructor
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database pool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($dbPool)
    {
    }

    /**
     * Add asset
     *
     * @param mixed $id        Asset id
     * @param mixed $asset     Asset
     * @param bool  $overwrite Overwrite
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function add($id, $asset, $overwrite = true)
    {
        if($overwrite || !isset($this->assets[$id])) {
            $this->assets[$id] = $asset;
        }
    }

    /**
     * Remove asset
     *
     * @param mixed $id Asset id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function remove($id)
    {
        if(isset($this->assets[$id])) {
            unset($this->assets[$id]);
        }
    }
}
