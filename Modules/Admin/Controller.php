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
class Controller extends \phpOMS\Module\ModuleAbstract implements \phpOMS\Module\WebInterface
{

// region Class Fields
    /**
     * Module name
     *
     * @var string
     * @since 1.0.0
     */
    protected static $module = 'Admin';

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
            case \phpOMS\Message\RequestDestination::API:
                $this->showAPI($request, $response);
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
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
        switch($request->getData()['l3']) {
            case 'account':
                $this->showBackendAccount($request, $response);
                break;
            case 'group':
                $this->showBackendGroup($request, $response);
                break;
            case 'settings':
                $this->showBackendSettings($request, $response);
                break;
            case 'module':
                $this->showBackendModule($request, $response);
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
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
    public function showBackendAccount($request, $response)
    {
        switch($request->getData()['l4']) {
            case 'list':
                $accountListView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $accountListView->setTemplate('/Modules/Admin/Theme/backend/accounts-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $accountListView->addData('nav', $navigation->nav);

                $accountList = new \Modules\Admin\Models\UserList($this->app->dbPool);
                $accountListView->setData('list:elements', $accountList->getList()['list']);
                $accountListView->setData('list:count', $accountList->getList()['count']);

                echo $accountListView->getOutput();
                break;
            case 'single':
                $this->showBackendAccountSingle($request, $response);
                break;
            case 'create':
                $accountCreateView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $accountCreateView->setTemplate('/Modules/Admin/Theme/backend/accounts-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $accountCreateView->addData('nav', $navigation->nav);
                echo $accountCreateView->getOutput();
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
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
    public function showBackendAccountSingle($request, $response)
    {
        switch($request->getData()['l5']) {
            case 'front':
                $accountView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $accountView->setTemplate('/Modules/Admin/Theme/backend/accounts-single');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $accountView->addData('nav', $navigation->nav);

                $account = \Model\Account::getInstance((int) $request->getData()['id'], $this->app->dbPool->get(), $this->app->sessionManager, $this->app->cache);
                $accountView->addData('account', $account);

                echo $accountView->getOutput();
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
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
    public function showBackendGroup($request, $response)
    {
        switch($request->getData()['l4']) {
            case 'list':
                $groupListView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $groupListView->setTemplate('/Modules/Admin/Theme/backend/groups-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $groupListView->addData('nav', $navigation->nav);

                $groupList = new \Modules\Admin\Models\GroupList($this->app->dbPool);
                $groupListView->setData('list:elements', $groupList->getList()['list']);
                $groupListView->setData('list:count', $groupList->getList()['count']);

                echo $groupListView->getOutput();
                break;
            case 'single':
                $this->showBackendGroupSingle($request, $response);
                break;
            case 'create':
                $groupCreateView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $groupCreateView->setTemplate('/Modules/Admin/Theme/backend/groups-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $groupCreateView->addData('nav', $navigation->nav);
                echo $groupCreateView->getOutput();
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
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
    public function showBackendGroupSingle($request, $response)
    {
        switch($request->getData()['l5']) {
            case 'front':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $accounts = new \Modules\Admin\Models\UserList($this->app->dbPool);

                /** @noinspection PhpUnusedLocalVariableInspection */
                $group = new \Modules\Admin\Models\Group((int) $request->getData()['id'], $this->app->dbPool->get(), $this->app->cache);

                if(!isset($request->getData()['page'])) {
                    $request->getData()['page'] = 1;
                }

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/groups-single.tpl.php';
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
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
    public function showBackendSettings($request, $response)
    {
        $this->app->settings->get([
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
                $coreSettingsView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $coreSettingsView->setTemplate('/Modules/Admin/Theme/backend/settings-general');
                echo $coreSettingsView->getOutput();
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
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
    public function showBackendModule($request, $response)
    {
        if(empty($request->getData()['l4'])) {
            $request->getData()['l5'] = 'front';
        }

        switch($request->getData()['l4']) {
            case 'list':
                $moduleListView = new \phpOMS\Views\View($this->app->user->getL11n(), $this->app);
                $moduleListView->setTemplate('/Modules/Admin/Theme/backend/modules-list');
                echo $moduleListView->getOutput();
                break;
            case 'front':
                //$info = $this->app->modules->moduleInfoGet((int)$request->getData()['id']);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/modules-single.tpl.php';
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Theme/backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows api content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function showAPI($request, $response)
    {
        switch($request->getData()['l3']) {
            case 'module':
                $this->apiModule($request, $response);
                break;
        }
    }

    /**
     * Shows api content
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function apiModule($request, $response)
    {
        switch($request->getRequestDestination()) {
            case \phpOMS\Message\RequestMethod::POST:
                $this->app->modules->install($request->getData('module'));
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                $response->setHeader('Status', 'Status:406 Not acceptable');

                return;
        }
    }
}