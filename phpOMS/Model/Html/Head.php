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
     * Is the header set?
     *
     * @var boolean
     * @since 1.0.0
     */
    private $hasContent = false;

    /**
     * Page meta
     *
     * @var \phpOMS\Model\Html\Meta
     * @since 1.0.0
     */
    private $meta = null;

    /**
     * html style
     *
     * Inline style
     *
     * @var mixed[]
     * @since 1.0.0
     */
    private $style = [];

    /**
     * html script
     *
     * @var mixed[]
     * @since 1.0.0
     */
    private $script = [];

// endregion

    public function __construct()
    {
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
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTitle()
    {
        return $this->title;
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
        $this->assets[$uri] = $type;
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
        $head = '';

        if($this->hasContent) {
            $head .= $this->meta->render();
            $head .= $this->renderStyle();
            $head .= $this->renderScript();
        }

        return $head;
    }

    public function setStyle($key, $style, $overwrite = true)
    {
        if($overwrite || !isset($this->script[$key])) {
            $this->style[$key] = $style;
        }
    }

    public function setScript($key, $script, $overwrite = true)
    {
        if($overwrite || !isset($this->script[$key])) {
            $this->script[$key] = $script;
        }
    }

    public function getStyleAll()
    {
        return $this->style;
    }

    public function getScriptAll()
    {
        return $this->script;
    }

    public function renderStyle()
    {
        $style = '';

        foreach($this->style as $css) {
            $style .= $css;
        }

        return $style;
    }

    public function renderScript()
    {
        $script = '';

        foreach($this->script as $js) {
            $script .= $js;
        }

        return $script;
    }

    public function renderAssets()
    {
        $asset = '';
        foreach($this->assets as $uri => $type) {
            if($type == \phpOMS\Asset\AssetType::CSS) {
                $asset .= '<link rel="stylesheet" type="text/css" href="' . $uri . '">';
            } elseif($type === \phpOMS\Asset\AssetType::JS) {
                $asset .= '<script src="' . $uri . '"></script>';
            }
        }

        return $asset;
    }
}