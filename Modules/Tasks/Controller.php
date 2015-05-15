<?php
namespace Modules\Tasks;

/**
 * Task class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Tasks
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
    protected static $module = 'Tasks';

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
     * @param \phpOMS\ApplicationAbstract $app Application reference
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
            case \phpOMS\Message\RequestDestination::API:
                $this->showContentApi($request, $response);
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
        // TODO: pull abstract view creation and output out. let error be a view as well -> less code writing
        switch($request->getPath(3)) {
            case 'dashboard':
                $taskDashboardView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $this->app);
                $taskDashboardView->setTemplate('/Modules/Tasks/Theme/backend/task-dashboard');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskDashboardView->addData('nav', $navigation->nav);
                echo $taskDashboardView->getOutput();
                break;
            case 'single':
                $taskSingleView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $this->app);
                $taskSingleView->setTemplate('/Modules/Tasks/Theme/backend/task-single');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskSingleView->addData('nav', $navigation->nav);
                echo $taskSingleView->getOutput();
                break;
            case 'create':
                $taskCreateView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $this->app);
                $taskCreateView->setTemplate('/Modules/Tasks/Theme/backend/task-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskCreateView->addData('nav', $navigation->nav);
                echo $taskCreateView->getOutput();
                break;
            case 'analysis':
                $taskAnalysisView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $this->app);
                $taskAnalysisView->setTemplate('/Modules/Tasks/Theme/backend/task-analysis');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskAnalysisView->addData('nav', $navigation->nav);
                echo $taskAnalysisView->getOutput();
                break;
            case 'settings':
                $taskSettingsView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $this->app);
                $taskSettingsView->setTemplate('/Modules/Tasks/Theme/backend/task-settings');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskSettingsView->addData('nav', $navigation->nav);
                echo $taskSettingsView->getOutput();
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
    public function showContentApi($request, $response)
    {
        switch($request->getPath(3)) {
            case 'create':
                // TODO: validate parameter/query
                // TODO: handle creation
                // TODO: return success (at least a notify msg for user information)?
                // + created id + destination url IFF creator = (first) receiver
                break;
        }
    }
}