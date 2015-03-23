<?php
namespace phpOMS\Views;

/**
 * List view
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
class View implements \phpOMS\Support\RenderableInterface
{
    /**
     * Template
     *
     * @var string
     * @since 1.0.0
     */
    protected $template = null;

    /**
     * Views
     *
     * @var \phpOMS\Views\View[]
     * @since 1.0.0
     */
    protected $views = [];

    /**
     * View data
     *
     * @var array
     * @since 1.0.0
     */
    protected $data = [];

    /**
     * User localized strings
     *
     * @var \phpOMS\Localization\Localization
     * @since 1.0.0
     */
    protected $l11n = null;

    /**
     * Application
     *
     * @var \phpOMS\ApplicationAbstract
     * @since 1.0.0
     */
    protected $app = null;

    /**
     * Constructor
     *
     * @param \phpOMS\Localization\Localization $l11n User localization
     * @param \phpOMS\ApplicationAbstract       $app  Application
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($l11n = null, $app = null)
    {
        $this->l11n = $l11n;
        $this->app  = $app;
    }

    /**
     * Set localization
     *
     * @param \phpOMS\Localization\Localization $l11n User localization
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLocalization($l11n = null)
    {
        $this->l11n = $l11n;
    }

    /**
     * Get the template
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set the template
     *
     * @param string $template
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @return View[]
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param string $id View ID
     *
     * @return false|View
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getView($id)
    {
        if(!isset($this->views[$id])) {
            return false;
        }

        return $this->views[$id];
    }

    /**
     * Remove view
     *
     * @param string $id View ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function removeView($id)
    {
        if(!isset($this->views[$id])) {
            return;
        }

        unset($this->views[$id]);
    }

    /**
     * Sort views by order
     *
     * @param array $a Array 1
     * @param array $b Array 2
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private static function viewSort($a, $b)
    {
        if($a['order'] === $b['order']) {
            return 0;
        }

        return ($a['order'] < $b['order']) ? -1 : 1;
    }

    /**
     * Add view
     *
     * @param string       $id        View ID
     * @param View $view
     * @param null|int     $order     Order of view
     * @param bool         $overwrite Overwrite existing view
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addView($id, $view, $order = null, $overwrite = false)
    {
        $this->views[$id] = $view;

        if($order !== null) {
            $this->views = uasort($this->views, ['\phpOMS\Views\View', 'viewSort']);
        }
    }

    /**
     * Edit view
     *
     * @param string       $id    View ID
     * @param View $view
     * @param null|int     $order Order of view
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function editView($id, $view, $order = null)
    {
        $this->addView($id, $view, $order, true);
    }

    /**
     * Get view/template response
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getOutput()
    {
        ob_start();
        /** @noinspection PhpIncludeInspection */
        include __DIR__ . '/../..' . $this->template . '.tpl.php';

        return ob_get_clean();
    }

    /**
     * Get view/template response of all views
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getOutputs()
    {
        ob_start();

        foreach($this->views as $key => $view) {
            echo $view->getOutput();
        }

        return ob_get_clean();
    }

    /**
     * @param string $id Data Id
     *
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getData($id)
    {
        return (!isset($this->data[$id]) ? null : $this->data[$id]);
    }

    /**
     * Remove view
     *
     * @param string $id Data Id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function removeData($id)
    {
        unset($this->data[$id]);
    }

    /**
     * @param string $id   Data ID
     * @param mixed  $data Data
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addData($id, $data)
    {
        $this->data[$id] = $data;
    }

    /**
     * @param string $id   Data ID
     * @param mixed  $data Data
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setData($id, $data)
    {
        $this->data[$id] = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function render() {}
}
