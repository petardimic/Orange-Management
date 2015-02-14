<?php
namespace Modules\Admin;

/**
 * Admin controller class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Controller extends \Framework\Module\ModuleAbstract implements \Framework\Module\WebInterface
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
     * @param \Framework\ApplicationAbstract $app Application instance
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
    public function call($type, $request, $data = null)
    {
        switch($request->getType()) {
            case \Framework\Message\Http\WebRequestPage::BACKEND:
                $this->showContentBackend($request);
                break;
            case \Framework\Message\Http\WebRequestPage::API:
                $this->showAPI($request);
                break;
        }
    }

    /**
     * Shows module content
     *
     * @param \Framework\Message\RequestAbstract $request Request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackend($request)
    {
        switch($request->getData()['l3']) {
            case 'account':
                $this->showBackendAccount($request);
                break;
            case 'group':
                $this->showBackendGroup($request);
                break;
            case 'settings':
                $this->showBackendSettings($request);
                break;
            case 'module':
                $this->showBackendModule($request);
                break;
            default:
                $this->app->response->addHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $this->app->response->addHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';
                return;
        }
    }

    /**
     * Shows module content
     *
     * @param \Framework\Message\RequestAbstract $request Request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendSettings($request)
    {
        $this->app->settings->loadSettings([
            1000000006,
            1000000007,
            1000000008,
            1000000012,
            1000000013,
            1000000014,
            1000000016,
            1000000017,
            1000000018,
            1000000019,
            1000000020,
            1000000021,
            1000000022,
            1000000023,
            1000000024,
            1000000025,
            1000000026
        ]);

        switch($request->getData()['l4']) {
            case 'general':
                $coreSettingsView = new \Framework\Views\ViewAbstract($this->app->user->getL11n());
                $coreSettingsView->setTemplate('/Modules/Admin/Theme/backend/settings-general');
                echo $coreSettingsView->getResponse();
                break;
            default:
                $this->app->response->addHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $this->app->response->addHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';
                return;
        }
    }

    /**
     * Shows module content
     *
     * @param \Framework\Message\RequestAbstract $request Request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendAccount($request)
    {
        switch($request->getData()['l4']) {
            case 'list':
                $accountListView = new \Framework\Views\ViewAbstract($this->app->user->getL11n());
                $accountListView->setTemplate('/Modules/Admin/Theme/backend/accounts-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $accountListView->addData('nav', $navigation->nav);
                echo $accountListView->getResponse();
                break;
            case 'single':
                $this->showBackendAccountSingle($request);
                $this->callPull();

                break;
            case 'create':
                $accountCreateView = new \Framework\Views\ViewAbstract($this->app->user->getL11n());
                $accountCreateView->setTemplate('/Modules/Admin/Theme/backend/accounts-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $accountCreateView->addData('nav', $navigation->nav);
                echo $accountCreateView->getResponse();
                break;
            default:
                $this->app->response->addHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $this->app->response->addHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';
                return;
        }
    }

    /**
     * Shows module content
     *
     * @param \Framework\Message\RequestAbstract $request Request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendAccountSingle($request)
    {
        switch($request->getData()['l5']) {
            case 'front':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/accounts-single.tpl.php';
                break;
            default:
                $this->app->response->addHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $this->app->response->addHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';
                return;
        }
    }

    /**
     * Shows module content
     *
     * @param \Framework\Message\RequestAbstract $request Request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendModule($request)
    {
        if(empty($request->getData()['l4'])) {
            $request->getData()['l5'] = 'front';
        }

        switch($request->getData()['l4']) {
            case 'list':
                $moduleListView = new \Framework\Views\ViewAbstract($this->app->user->getL11n());
                $moduleListView->setTemplate('/Modules/Admin/Theme/backend/modules-list');
                echo $moduleListView->getResponse();
                break;
            case 'front':
                //$info = $this->app->modules->moduleInfoGet((int)$request->getData()['id']);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/modules-single.tpl.php';
                break;
            default:
                $this->app->response->addHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $this->app->response->addHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';
                return;
        }
    }

    /**
     * Shows module content
     *
     * @param \Framework\Message\RequestAbstract $request Request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendGroup($request)
    {
        switch($request->getData()['l4']) {
            case 'list':
                $groupListView = new \Framework\Views\ViewAbstract($this->app->user->getL11n());
                $groupListView->setTemplate('/Modules/Admin/Theme/backend/groups-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $groupListView->addData('nav', $navigation->nav);
                echo $groupListView->getResponse();
                break;
            case 'single':
                $this->showBackendGroupSingle($request);
                break;
            case 'create':
                $groupCreateView = new \Framework\Views\ViewAbstract($this->app->user->getL11n());
                $groupCreateView->setTemplate('/Modules/Admin/Theme/backend/groups-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $groupCreateView->addData('nav', $navigation->nav);
                echo $groupCreateView->getResponse();
                break;
            default:
                $this->app->response->addHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $this->app->response->addHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';
                return;
        }
    }

    /**
     * Shows module content
     *
     * @param \Framework\Message\RequestAbstract $request Request
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendGroupSingle($request)
    {
        switch($request->getData()['l5']) {
            case 'front':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $accounts = new \Modules\Admin\Models\UserList($this->app->dbPool);

                /** @noinspection PhpUnusedLocalVariableInspection */
                $group = new \Framework\Models\Group\Group((int) $request->getData()['id'], $this->app);

                if(!isset($request->getData()['page'])) {
                    $request->getData()['page'] = 1;
                }

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/groups-single.tpl.php';
                break;
            default:
                $this->app->response->addHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $this->app->response->addHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';
                return;
        }
    }

    public function showAPI($request)
    {
    }
}