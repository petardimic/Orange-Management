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
    public function call($type, $request, $response, $data = null)
    {
        switch($request->getType()) {
            case \phpOMS\Message\Http\WebRequestPage::BACKEND:
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
        // TODO: pull abstract view creation and output out. let error be a view as well -> less code writing
        switch($request->getData()['l3']) {
            case 'dashboard':
                $taskDashboardView = new \phpOMS\Views\ViewAbstract($this->app->user->getL11n(), $this->app);
                $taskDashboardView->setTemplate('/Modules/Tasks/Theme/backend/task-dashboard');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskDashboardView->addData('nav', $navigation->nav);
                echo $taskDashboardView->getOutput();
                break;
            case 'single':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $task = new \Modules\Tasks\Models\Task($this->app->dbPool);
                $task->init($request->getData()['id']);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/task-single.tpl.php';
                break;
            case 'create':
                $taskCreateView = new \phpOMS\Views\ViewAbstract($this->app->user->getL11n(), $this->app);
                $taskCreateView->setTemplate('/Modules/Tasks/Theme/backend/task-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskCreateView->addData('nav', $navigation->nav);
                echo $taskCreateView->getOutput();
                break;
            case 'analysis':
                $taskAnalysisView = new \phpOMS\Views\ViewAbstract($this->app->user->getL11n(), $this->app);
                $taskAnalysisView->setTemplate('/Modules/Tasks/Theme/backend/task-analysis');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskAnalysisView->addData('nav', $navigation->nav);
                echo $taskAnalysisView->getOutput();
                break;
            case 'settings':
                $taskSettingsView = new \phpOMS\Views\ViewAbstract($this->app->user->getL11n(), $this->app);
                $taskSettingsView->setTemplate('/Modules/Tasks/Theme/backend/task-settings');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskSettingsView->addData('nav', $navigation->nav);
                echo $taskSettingsView->getOutput();
                break;
        }
    }
}