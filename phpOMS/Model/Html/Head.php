<?php
namespace phpOMS\Model\Html;

/**
 * Logging class
 *
 * PHP Version 5.4
 *
 * @category   Log
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Head implements \phpOMS\Contract\RenderableInterface
{

// region Class Fields
    /**
     * Page language
     *
     * @var string
     * @since 1.0.0
     */
    private $language = '';

    /**
     * Page title
     *
     * @var string
     * @since 1.0.0
     */
    private $title = '';

    /**
     * Assets bound to this page instance
     *
     * @var array
     * @since 1.0.0
     */
    private $assets = [];

    /**
     * Page meta
     *
     * @var \phpOMS\Model\Html\Meta
     * @since 1.0.0
     */
    private $meta = null;

// endregion

    public function __construct() {
        $this->meta = new \phpOMS\Model\Html\Meta();
    }

    /**
     * Set page meta
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set page title
     *
     * @param string $title Page title
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set page title
     *
     * @param string $type Asset type
     * @param string $uri  Asset uri
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addAsset($type, $uri)
    {
        $this->assets[$uri] = [$type];
    }

    /**
     * Set page language
     *
     * @param string $language language string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function render()
    {
        // TODO: Implement render() method.
    }
}