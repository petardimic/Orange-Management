<?php
namespace Modules\Business;

/**
 * Business Controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Business
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Controller extends \phpOMS\Module\ModuleAbstract implements \phpOMS\Module\WebInterface
{

// region Class Fields
    /**
     * Module name
     *
     * @var string
     * @since 1.0.0
     */
    protected static $module = 'Business';

    /**
     * Localization files
     *
     * @var string
     * @since 1.0.0
     */
    protected static $localization = [
        \phpOMS\Message\RequestDestination::BACKEND => 'backend',
    ];

    /**
     * Providing
     *
     * @var string
     * @since 1.0.0
     */
    protected static $providing = [
        'Content',
    ];

    /**
     * Dependencies
     *
     * @var string
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];
// endregion

    /**
     * Constructor
     *
     * @param \phpOMS\ApplicationAbstract $app Application instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * {@inheritdoc}
     */
    public function call($request, $response, $data = null)
    {
        switch($request->getRequestDestination()) {
            case \phpOMS\Message\RequestDestination::BACKEND:
                $this->showContentBackend($request, $response);
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackend($request, $response)
    {
        switch($request->getPath(3)) {
            case 'unit':
                $this->showContentBackendUnit($request, $response);
                break;
            case 'department':
                $this->showContentBackendDepartment($request, $response);
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackendUnit($request, $response)
    {
        switch($request->getPath(4)) {
            case 'list':
                $unitListView = new \phpOMS\Views\View($this->app, $request, $response);
                $unitListView->setTemplate('/Modules/Business/Theme/backend/unit-list');
                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $unitListView->addData('nav', $navigation->nav);

                echo $unitListView->render();
                break;
            case 'create':
                $unitCreateView = new \phpOMS\Views\View($this->app, $request, $response);
                $unitCreateView->setTemplate('/Modules/Business/Theme/backend/unit-create');
                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $unitCreateView->addData('nav', $navigation->nav);

                echo $unitCreateView->render();
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackendDepartment($request, $response)
    {
        switch($request->getPath(4)) {
            case 'list':
                $departmentListView = new \phpOMS\Views\View($this->app, $request, $response);
                $departmentListView->setTemplate('/Modules/Business/Theme/backend/department-list');
                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $departmentListView->addData('nav', $navigation->nav);

                echo $departmentListView->render();
                break;
            case 'create':
                $departmentCreateView = new \phpOMS\Views\View($this->app, $request, $response);
                $departmentCreateView->setTemplate('/Modules/Business/Theme/backend/department-create');
                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $departmentCreateView->addData('nav', $navigation->nav);

                echo $departmentCreateView->render();
                break;
        }
    }
}