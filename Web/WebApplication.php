<?php
namespace Web;

/**
 * Controller class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class WebApplication extends \phpOMS\ApplicationAbstract
{

    /**
     * Main request
     *
     * @var \phpOMS\Message\Http\Request
     * @since 1.0.0
     */
    public $request = null;

    /**
     * Main request
     *
     * @var \phpOMS\Message\Http\Response
     * @since 1.0.0
     */
    public $response = null;

    /**
     * User session
     *
     * @var \phpOMS\DataStorage\Session\SessionInterface
     * @since 1.0.0
     */
    public $session = null;

    /**
     * Constructor
     *
     * @param array $config Core config
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($config)
    {
        $this->request = new \phpOMS\Message\Http\Request($config['page']['root']);
        $this->request->init();
        $this->response = new \phpOMS\Message\Http\Response();

        $this->dbPool = new \phpOMS\DataStorage\Database\Pool();
        $this->dbPool->create('core', $config['db']);

        $pageView = null;

        switch($this->request->getRequestDestination()) {
            case \phpOMS\Message\RequestDestination::WEBSITE:

                break;
            case \phpOMS\Message\RequestDestination::BACKEND:
                if($this->request->getMethod() !== \phpOMS\Message\RequestMethod::GET) {
                    $this->response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                    $this->response->setHeader('Status', 'Status:406 Not acceptable');
                    break;
                }

                $this->response->setHeader('Content-Type', 'Content-Type: text/html; charset=utf-8');

                $pageView = new \Web\Views\Page\BackendView(null, $this->request, $this->response);

                if($this->dbPool->get()->getStatus() !== \phpOMS\DataStorage\Database\DatabaseStatus::OK) {
                    $this->dbFailResponse($pageView);
                    break;
                }

                $this->setupBasic();
                $this->request->setAccount($this->user);

                $this->user->getL11n()->loadCoreLanguage($this->request->getLanguage());
                $this->user->getL11n()->loadThemeLanguage($this->request->getLanguage(), 'backend');
                $pageView->setLocalization($this->user->getL11n());

                $head    = $this->response->getHead();
                $baseUri = $this->request->getUri()->getBase();

                if($this->user->getId() < 1) {
                    $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'External/fontawesome/css/font-awesome.min.css');
                    $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'jsOMS/oms.min.js');
                    $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'Web/Theme/backend/js/backend.js');
                    $head->setScript('core', 'var Url = "' . $baseUri . '", assetManager = new jsOMS.AssetManager();');

                    $pageView->setTemplate('/Web/Theme/backend/login');
                    $this->response->add('GLOBAL', $pageView->render());
                    break;
                }

                // TODO: mybe don't use DB and instead use uri for loads (if module exists load it -> no activity check which could be bad)
                $toLoad = $this->moduleManager->getUriLoads($this->request);

                if(isset($toLoad[4])) {
                    foreach($toLoad[4] as $module) {
                        \phpOMS\Module\ModuleFactory::getInstance($module['file']);
                    }
                }

                $options = $this->settings->get([1000000009]);
                $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'Web/Theme/backend/css/backend.css');
                $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'External/fontawesome/css/font-awesome.min.css');
                $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'jsOMS/oms.min.js');
                $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'External/d3/d3.min.js');
                $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'Web/Theme/backend/js/backend.js');
                $head->setStyle('core', file_get_contents(__DIR__ . '/Theme/backend/css/backend-small.css'));
                $head->setScript('core', 'var Url = "' . $baseUri . '", assetManager = new jsOMS.AssetManager();');

                $pageView->setData('Name', $options[1000000009]);
                $pageView->setData('Title', 'Orange Management');
                $pageView->setData('Destination', $this->request->getRequestDestination());

                $pageView->setTemplate('/Web/Theme/backend/index');
                $navigation = \Modules\Navigation\Models\Navigation::getInstance($this->request->getHash(), $this->dbPool);
                $pageView->addData('nav', $navigation->nav);
                $this->response->add('GLOBAL', $pageView->render());
                break;
            case \phpOMS\Message\RequestDestination::API:
                if($this->dbPool->get()->getStatus() !== \phpOMS\DataStorage\Database\DatabaseStatus::OK) {
                    $this->response->setHeader('HTTP', 'HTTP/1.0 503 Service Temporarily Unavailable');
                    $this->response->setHeader('Status', 'Status: 503 Service Temporarily Unavailable');
                    $this->response->setHeader('Retry-After', 'Retry-After: 300');
                    break;
                }

                $this->setupBasic();
                $this->request->setAccount($this->user);

                $this->response->setHeader('Content-Type', 'Content-Type: application/json; charset=utf-8');
                $this->response->add('GLOBAL', new \phpOMS\Utils\JsonBuilder());
                $this->response->get('GLOBAL')->add($this->request->__toString(), null);

                $request = new \phpOMS\Message\Http\Request($config['page']['root']);

                if(($uris = $this->request->getUri()->getQuery('r')) !== null) {
                    $uris = json_decode($uris, true);

                    foreach($uris as $key => $uri) {
                        $request->init($uri);
                        $toLoad = $this->moduleManager->getUriLoads($request);

                        if(isset($toLoad[4])) {
                            foreach($toLoad[4] as $module) {
                                \phpOMS\Module\ModuleFactory::getInstance($module['file']);
                            }
                        }

                        /** @noinspection PhpUndefinedMethodInspection */
                        $this->moduleManager->running['Content']->call($request, $this->response);
                    }
                } else {
                    $request = $this->request;

                    if($this->user->getId() < 1) {
                        if($request->getPath(2) === 'login') {
                            $login = $this->user->login($this->request->getData('user'), $this->request->getData('pass'));

                            if($login === \phpOMS\Auth\LoginReturnType::OK) {
                                //$this->response->get('GLOBAL')->add($this->request->__toString(), $this->sessionManager->getSID());
                                $this->response->get('GLOBAL')->add($this->request->__toString(), (new \Model\Message\Reload())->toArray());
                                $this->response->add('GLOBAL', $this->response->get('GLOBAL')->__toString());
                            } else {
                                // TODO: create login failure msg
                            }

                            break;
                        }
                    } else {
                        if($request->getPath(2) === 'logout') {
                            $this->sessionManager->remove('UID');
                            $this->sessionManager->save();
                            $this->response->get('GLOBAL')->add($this->request->__toString(), 1);
                            $this->response->add('GLOBAL', $this->response->get('GLOBAL')->__toString());
                            break;
                        }
                    }

                    $toLoad = $this->moduleManager->getUriLoads($this->request);

                    if(isset($toLoad[4])) {
                        foreach($toLoad[4] as $module) {
                            \phpOMS\Module\ModuleFactory::getInstance($module['file']);
                        }
                    }

                    if(isset(\phpOMS\Module\ModuleFactory::$loaded['Content'])) {
                        /** @noinspection PhpUndefinedMethodInspection */
                        \phpOMS\Module\ModuleFactory::$loaded['Content']->call($this->request, $this->response);
                    }
                }

                $this->response->add('GLOBAL', $this->response->get('GLOBAL')->__toString());
                break;
            case \phpOMS\Message\RequestDestination::RAW:
                if($this->request->getMethod() !== \phpOMS\Message\RequestMethod::GET) {
                    $this->response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                    $this->response->setHeader('Status', 'Status:406 Not acceptable');
                    break;
                }

                $this->response->setHeader('Content-Type', 'text/html; charset=utf-8');

                $pageView = new \Web\Views\Page\BackendView(null, $this->request, $this->response);

                if($this->dbPool->get()->getStatus() !== \phpOMS\DataStorage\Database\DatabaseStatus::OK) {
                    $this->dbFailResponse($pageView);
                    break;
                }

                $this->setupBasic();
                $this->request->setAccount($this->user);

                $this->user->getL11n()->loadCoreLanguage($this->request->getLanguage());
                $this->user->getL11n()->loadThemeLanguage($this->request->getLanguage(), 'backend');
                $pageView->setLocalization($this->user->getL11n());

                $head    = $this->response->getHead();
                $baseUri = $this->request->getUri()->getBase();

                if($this->user->getId() < 1) {
                    $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'External/fontawesome/css/font-awesome.min.css');
                    $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'jsOMS/oms.min.js');
                    $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'Web/Theme/backend/js/backend.js');
                    $head->setScript('core', 'var Url = "' . $baseUri . '", assetManager = new jsOMS.AssetManager();');

                    $pageView->setTemplate('/Web/Theme/backend/login');
                    $this->response->add('GLOBAL', $pageView->render());
                    break;
                }

                // TODO: mybe don't use DB and instead use uri for loads (if module exists load it -> no activity check which could be bad)
                $toLoad = $this->moduleManager->getUriLoads($this->request);

                if(isset($toLoad[4])) {
                    foreach($toLoad[4] as $module) {
                        \phpOMS\Module\ModuleFactory::getInstance($module['file']);
                    }
                }

                $pageView->setTemplate('/Web/Theme/raw/index');
                $this->response->add('GLOBAL', $pageView->render());
                break;
            case \phpOMS\Message\RequestDestination::REPORTER:
                if($this->request->getMethod() !== \phpOMS\Message\RequestMethod::GET) {
                    $this->response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                    $this->response->setHeader('Status', 'Status:406 Not acceptable');
                    break;
                }

                $this->response->setHeader('Content-Type', 'Content-Type: text/html; charset=utf-8');
                $pageView = new \Web\Views\Page\BackendView(null, $this->request, $this->response);

                if($this->dbPool->get()->getStatus() !== \phpOMS\DataStorage\Database\DatabaseStatus::OK) {
                    $this->dbFailResponse($pageView);
                    break;
                }

                $this->setupBasic();
                $this->request->setAccount($this->user);

                $this->user->getL11n()->loadCoreLanguage($this->request->getLanguage());
                $this->user->getL11n()->loadThemeLanguage($this->request->getLanguage(), 'reporter');
                $pageView->setLocalization($this->user->getL11n());

                $head    = $this->response->getHead();
                $baseUri = $this->request->getUri()->getBase();

                if($this->user->getId() < 1) {
                    $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'External/fontawesome/css/font-awesome.min.css');
                    $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'jsOMS/oms.min.js');
                    $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'Web/Theme/backend/js/backend.js');
                    $head->setScript('core', 'var Url = "' . $baseUri . '", assetManager = new jsOMS.AssetManager();');

                    $pageView->setTemplate('/Web/Theme/backend/login');
                    $this->response->add('GLOBAL', $pageView->render());
                    break;
                }

                $toLoad = $this->moduleManager->getUriLoads($this->request);

                if(isset($toLoad[4])) {
                    foreach($toLoad[4] as $module) {
                        \phpOMS\Module\ModuleFactory::getInstance($module['file']);
                    }
                }

                $options = $this->settings->get([1000000009]);
                $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'Web/Theme/backend/css/backend.css');
                $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'External/fontawesome/css/font-awesome.min.css');
                $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'jsOMS/oms.min.js');
                $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'External/d3/d3.min.js');
                $head->setStyle('core', file_get_contents(__DIR__ . '/Theme/backend/css/backend-small.css'));
                $head->setScript('core', 'var Url = "' . $baseUri . '", assetManager = new jsOMS.AssetManager();');

                $pageView->setData('Name', $options[1000000009]);
                $pageView->setData('Title', 'Orange Management');
                $pageView->setData('Destination', $this->request->getRequestDestination());

                $pageView->setTemplate('/Web/Theme/reporter/index');
                $navigation = \Modules\Navigation\Models\Navigation::getInstance($this->request->getHash(), $this->dbPool);
                $pageView->addData('nav', $navigation->nav);
                $this->response->add('GLOBAL', $pageView->render());
                break;
            default:
                $this->response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $this->response->setHeader('Status', 'Status: 404 Not Found');

                $pageView = new \phpOMS\Views\View(null, $this->request, $this->response);
                $pageView->setTemplate('/Web/Theme/Error/404');
                $this->response->add('GLOBAL', $pageView->render());
        }

        echo $this->response->render();
    }

    /**
     * Generate visual database error
     *
     * @param \phpOMS\Views\View $view View
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function dbFailResponse(&$view)
    {
        $this->response->setHeader('HTTP', 'HTTP/1.0 503 Service Temporarily Unavailable');
        $this->response->setHeader('Status', 'Status: 503 Service Temporarily Unavailable');
        $this->response->setHeader('Retry-After', 'Retry-After: 300');

        $view->setTemplate('/Web/Theme/Error/503');
    }

    /**
     * Setup basic instances
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function setupBasic()
    {
        $this->cache    = new \phpOMS\DataStorage\Cache\Cache($this->dbPool);
        $this->settings = new \Model\CoreSettings($this->dbPool->get());

        \phpOMS\Module\ModuleFactory::$app = $this;
        \phpOMS\Model\Model::$app          = $this;

        $this->eventManager   = new \phpOMS\Event\EventManager();
        $this->sessionManager = new \phpOMS\DataStorage\Session\HttpSession(36000);
        $this->moduleManager  = new \phpOMS\Module\ModuleManager($this->dbPool);
        $this->user           = new \Model\Account(0, $this->dbPool->get(), $this->sessionManager, $this->cache);
        $this->user->authenticate();
    }
}
