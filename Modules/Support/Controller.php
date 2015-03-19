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
            case 'list':
                $supportDashboardView = new \phpOMS\Views\ViewAbstract($this->app->user->getL11n(), $this->app);
                $supportDashboardView->setTemplate('/Modules/Support/Theme/backend/support-dashboard');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportDashboardView->addData('nav', $navigation->nav);
                echo $supportDashboardView->getOutput();
                break;
            case 'single':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $support = new \Modules\Tasks\Models\Task($this->app->dbPool);
                $support->init($request->getData()['id']);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/support-single.tpl.php';
                break;
            case 'create':
                $supportCreateView = new \phpOMS\Views\ViewAbstract($this->app->user->getL11n(), $this->app);
                $supportCreateView->setTemplate('/Modules/Support/Theme/backend/support-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportCreateView->addData('nav', $navigation->nav);
                echo $supportCreateView->getOutput();
                break;
            case 'analysis':
                $supportAnalysisView = new \phpOMS\Views\ViewAbstract($this->app->user->getL11n(), $this->app);
                $supportAnalysisView->setTemplate('/Modules/Support/Theme/backend/support-analysis');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportAnalysisView->addData('nav', $navigation->nav);
                echo $supportAnalysisView->getOutput();
                break;
            case 'settings':
                $supportSettingsView = new \phpOMS\Views\ViewAbstract($this->app->user->getL11n(), $this->app);
                $supportSettingsView->setTemplate('/Modules/Support/Theme/backend/support-settings');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportSettingsView->addData('nav', $navigation->nav);
                echo $supportSettingsView->getOutput();
                break;
        }
    }
}