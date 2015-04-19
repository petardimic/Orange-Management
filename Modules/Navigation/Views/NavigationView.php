<?php
namespace Modules\Navigation\Views;

/**
 * Navigation view
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
class NavigationView extends \phpOMS\Views\View
{
    /**
     * Navigation Id
     *
     * This is getting used in order to identify which navigation elements should get rendered.
     * This usually is the parent navigation id
     *
     * @var null|int
     * @since 1.0.0
     */
    protected $navId = null;

    /**
     * Navigation
     *
     * @var mixed[]
     * @since 1.0.0
     */
    protected $nav = [];

    /**
     * Language used for the navigation
     *
     * @var string
     * @since 1.0.0
     */
    protected $language = 'en';

    /**
     * Parent element used for navigation
     *
     * @var int
     * @since 1.0.0
     */
    protected $parent = 0;

    /**
     * {@inheritdoc}
     */
    public function __construct($l11n)
    {
        parent::__construct($l11n);
    }

    /**
     * Set navigation Id
     *
     * @param int $navId Navigation id used for display
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setNavId($navId)
    {
        $this->navId = $navId;
    }

    /**
     * Get navigation Id
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getNavId()
    {
        return $this->navId;
    }

    /**
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getNav()
    {
        return $this->nav;
    }

    /**
     * @param mixed $nav
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setNav($nav)
    {
        $this->nav = $nav;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param int $parent
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
}