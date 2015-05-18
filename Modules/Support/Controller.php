<?php
namespace Modules\Support;

/**
 * Support controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Support
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
    protected static $module = 'Support';

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
            case 'list':
                $supportDashboardView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $supportDashboardView->setTemplate('/Modules/Support/Theme/backend/support-dashboard');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportDashboardView->addData('nav', $navigation->nav);
                echo $supportDashboardView->render();
                break;
            case 'single':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $support = new \Modules\Tasks\Models\Task($this->app->dbPool);
                $support->init($request->getData('id'));

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/support-single.tpl.php';
                break;
            case 'create':
                $supportCreateView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $supportCreateView->setTemplate('/Modules/Support/Theme/backend/support-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportCreateView->addData('nav', $navigation->nav);
                echo $supportCreateView->render();
                break;
            case 'analysis':
                $supportAnalysisView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $supportAnalysisView->setTemplate('/Modules/Support/Theme/backend/support-analysis');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportAnalysisView->addData('nav', $navigation->nav);
                echo $supportAnalysisView->render();
                break;
            case 'settings':
                $supportSettingsView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $supportSettingsView->setTemplate('/Modules/Support/Theme/backend/support-settings');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportSettingsView->addData('nav', $navigation->nav);
                echo $supportSettingsView->render();
                break;
            case 'support':
                $this->showContentBackendPrivate($request, $response);
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
    public function showContentBackendPrivate($request, $response)
    {
        switch($request->getPath(4)) {
            case 'dashboard':
                $supportDashboardView = new \phpOMS\Views\View($this->app->user->getL11n(), $request, $response, $this->app);
                $supportDashboardView->setTemplate('/Modules/Support/Theme/backend/user-support-dashboard');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportDashboardView->addData('nav', $navigation->nav);
                echo $supportDashboardView->render();
                break;
        }
    }
}