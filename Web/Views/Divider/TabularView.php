<?php
namespace Web\Views\Divider;

/**
 * Form view
 *
 * PHP Version 5.4
 *
 * @category   Theme
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class TabularView extends \Web\Views\WebViewAbstract
{
    protected $active = 1;

    protected $tab = [];

    /**
     * {@inheritdoc}
     */
    public function __construct($l11n)
    {
        parent::__construct($l11n);
    }

    public function addTab($title, $view, $id = null) {
        if(!isset($id)) {
            $id = $title;
        }

        $this->tab[$id]['title'] = $title;
        $this->tab[$id]['content'] = $view;
    }
}