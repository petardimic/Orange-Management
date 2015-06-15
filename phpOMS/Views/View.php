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
class View implements \phpOMS\Contract\RenderableInterface
{

// region Class Fields
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
     * @var array
     * @since 1.0.0
     */
    protected $lang = null;

    /**
     * Application
     *
     * @var \phpOMS\ApplicationAbstract
     * @since 1.0.0
     */
    protected $app = null;

    /**
     * Request
     *
     * @var \phpOMS\Message\RequestAbstract
     * @since 1.0.0
     */
    protected $request = null;

    /**
     * Request
     *
     * @var \phpOMS\Message\RequestAbstract
     * @since 1.0.0
     */
    protected $response = null;

// endregion

    /**
     * Constructor
     *
     * @param \phpOMS\Message\RequestAbstract   $request  Request
     * @param \phpOMS\Message\ResponseAbstract  $response Request
     * @param \phpOMS\ApplicationAbstract       $app      Application
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app, $request, $response)
    {
        $this->app      = $app;
        $this->request  = $request;
        $this->response = $response;
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
     * Edit view
     *
     * @param string   $id    View ID
     * @param View     $view
     * @param null|int $order Order of view
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function editView($id, $view, $order = null)
    {
        $this->addView($id, $view, $order, true);
    }

    /**
     * Add view
     *
     * @param string   $id        View ID
     * @param View     $view
     * @param null|int $order     Order of view
     * @param bool     $overwrite Overwrite existing view
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addView($id, $view, $order = null, $overwrite = true)
    {
        if($overwrite || !isset($this->views[$id])) {
            $this->views[$id] = $view;

            if($order !== null) {
                $this->views = uasort($this->views, ['\phpOMS\Views\View', 'viewSort']);
            }
        }
    }

    /**
     * Get view/template response of all views
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function renderAll()
    {
        ob_start();

        foreach($this->views as $key => $view) {
            echo $view->render();
        }

        return ob_get_clean();
    }

    /**
     * Get view/template response
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function render()
    {
        $this->l11n = $this->response->getL11n();

        ob_start();
        /** @noinspection PhpIncludeInspection */
        include realpath(__DIR__ . '/../..' . $this->template . '.tpl.php');

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
}
