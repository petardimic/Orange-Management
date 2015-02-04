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
class NavigationView extends \Framework\Views\ViewAbstract {
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

	protected $nav = null;

	/**
     * {@inheritdoc}
     */
	public function __construct($l11n) {
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
	public function setNavId($navId) {
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
	public function getNavId() {
		return $this->navId;
	}
}