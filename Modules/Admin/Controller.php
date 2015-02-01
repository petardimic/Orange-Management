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
        1004400000
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
     * @param \Framework\WebApplication $app Application instance
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
    public function call($type, $data = null)
    {
        switch($this->app->request->getType()) {
            case \Framework\Message\Http\WebRequestPage::BACKEND:
                $this->showContentBackend();
                break;
        }
    }

    /**
     * Shows module content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackend()
    {
        switch($this->app->request->getData()['l3']) {
            case 'account':
                $this->showBackendAccount();
                break;
            case 'group':
                $this->showBackendGroup();
                break;
            case 'settings':
                $this->showBackendSettings();
                break;
            case 'module':
                $this->showBackendModule();
                break;
        }

        return false;
    }

    /**
     * Shows module content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendSettings()
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

        switch($this->app->request->getData()['l4']) {
            case 'general':
                \Framework\Model\Model::$content['page::title'] = $this->app->user->getL11n()->lang[1]['SettingsGeneral'];

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/settings-general.tpl.php';
                break;
        }
    }

    /**
     * Shows module content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendAccount()
    {
        switch($this->app->request->getData()['l4']) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $accounts = new \Modules\Admin\Models\UserList($this->app->dbPool);

                if(!isset($this->app->request->getData()['page'])) {
                    $this->app->request->getData()['page'] = 1;
                }

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/accounts-list.tpl.php';
                break;
            case 'single':
                $this->showBackendAccountSingle();
                $this->callPull();

                break;
            case 'create':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/accounts-create.tpl.php';
                break;
        }
    }

    /**
     * Shows module content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendAccountSingle()
    {
        switch($this->app->request->getData()['l5']) {
            case 'front':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/accounts-single.tpl.php';
                break;
        }
    }

    /**
     * Shows module content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendModule()
    {
        if(empty($this->app->request->getData()['l4'])) {
            $this->app->request->getData()['l5'] = 'front';
        }

        switch($this->app->request->getData()['l4']) {
            case 'list':
                if(!isset($this->app->request->getData()['page'])) {
                    $this->app->request->getData()['page'] = 1;
                }

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/modules-list.tpl.php';
                break;
            case 'front':
                //$info = $this->app->modules->moduleInfoGet((int)$this->app->request->getData()['id']);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/modules-single.tpl.php';
                break;
        }
    }

    /**
     * Shows group content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendGroup()
    {
        switch($this->app->request->getData()['l4']) {
            case 'list':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $groups = new \Modules\Admin\Models\GroupList($this->app->dbPool);

                if(!isset($this->app->request->getData()['page'])) {
                    $this->app->request->getData()['page'] = 1;
                }

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/groups-list.tpl.php';
                break;
            case 'single':
                $this->showBackendGroupSingle();
                break;
            case 'create':
                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/groups-create.tpl.php';
                break;
        }
    }

    /**
     * Shows group single content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendGroupSingle()
    {
        switch($this->app->request->getData()['l5']) {
            case 'front':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $accounts = new \Modules\Admin\Models\UserList($this->app->dbPool);

                /** @noinspection PhpUnusedLocalVariableInspection */
                $group = new \Framework\Object\Group\Group((int) $this->app->request->getData()['id'], $this->app);

                if(!isset($this->app->request->getData()['page'])) {
                    $this->app->request->getData()['page'] = 1;
                }

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/backend/groups-single.tpl.php';
                break;
        }
    }

    /**
     * Handle api call
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showApi()
    {
        switch($this->app->request->getData()['l3']) {
            case 'account':
                $this->apiAccount();
                break;
            case 'group':
                $this->apiGroup();
                break;
            case 'settings':
                $this->apiSettings();
                break;
            case 'module':
                $this->apiModule();
                break;
            default:
                return false;
        }

        return true;
    }

    /**
     * Handle api account call
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiAccount()
    {
        switch($this->app->request->getType()) {
            case \Framework\Message\RequestType::PUT:
                $this->apiPutAccount();
                break;
            case \Framework\Message\RequestType::DELETE:
                $this->apiDeleteAccount();
                break;
            case \Framework\Message\RequestType::POST:
                $this->apiPostAccount();
                break;
            case \Framework\Message\RequestType::GET:
                $this->apiGetAccount();
                break;
            default:
                return false;
        }

        return true;
    }

    /**
     * Handle api account create
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiPutAccount()
    {
    }

    /**
     * Handle api account delete
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiDeleteAccount()
    {
    }

    /**
     * Handle api account modification
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiPostAccount()
    {
    }

    /**
     * Handle api account get
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiGetAccount()
    {
    }

    /**
     * Handle api group call
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiGroup()
    {
        switch($this->app->request->getType()) {
            case \Framework\Message\RequestType::PUT:
                $this->apiPutGroup();
                break;
            case \Framework\Message\RequestType::DELETE:
                $this->apiDeleteGroup();
                break;
            case \Framework\Message\RequestType::POST:
                $this->apiPostGroup();
                break;
            case \Framework\Message\RequestType::GET:
                $this->apiGetGroup();
                break;
            default:
                return false;
        }

        return true;
    }

    /**
     * Handle api group create
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiPutGroup()
    {
    }

    /**
     * Handle api group delete
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiDeleteGroup()
    {
    }

    /**
     * Handle api group modification
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiPostGroup()
    {
    }

    /**
     * Handle api group get
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiGetGroup()
    {
    }

    /**
     * Handle api settings call
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiSettings()
    {
        $settings = \Framework\Config\Settings::getInstance();

        switch($this->app->request->getData()['l4']) {
            case 'core':
                $settings->setSettings($this->app->request->getData()['settigns']);

                $jsonRet = [
                    'type'   => 1,
                    'status' => 1,
                    'msg'    => $this->app->user->getL11n()->lang[1]['i:SettingsSet']
                ];

                echo json_encode($jsonRet);
                break;
            case 'modules':
                break;
            default:
                return false;
        }

        return true;
    }

    /**
     * Handle api module call
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function apiModule()
    {
        switch($this->app->request->getType()) {
            case \Framework\Message\RequestType::PUT:
                \Framework\Install\Module::install($this->app->db, $this->app->request->getData()['id']);

                $jsonRet = [
                    'type'   => 1,
                    'status' => 1,
                    'msg'    => str_replace('{$1}', $this->app->request->getData()['id'], $this->app->user->getL11n()->lang[1]['i:ModuleInstalled'])
                ];

                echo json_encode($jsonRet);
                break;
            case \Framework\Message\RequestType::DELETE:
                echo '1';
                break;
            case \Framework\Message\RequestType::POST:
                echo '2';
                break;
            case \Framework\Message\RequestType::GET:
                break;
            default:
                echo '3';

                return false;
        }

        return true;
    }
}