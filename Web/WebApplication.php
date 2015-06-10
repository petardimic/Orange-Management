<?php
namespace Web;

/**
 * Application class
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
     * Constructor
     *
     * @param array $config Core config
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($config)
    {
        $request      = new \phpOMS\Message\Http\Request($config['page']['root']);
        $response     = new \phpOMS\Message\Http\Response();
        $this->dbPool = new \phpOMS\DataStorage\Database\Pool();
        $pageView     = null;

        $request->init();
        $this->dbPool->create('core', $config['db']);

        switch($request->getRequestDestination()) {
            case \phpOMS\Message\RequestDestination::WEBSITE:

                break;
            case \phpOMS\Message\RequestDestination::BACKEND:
                $response->setHeader('Content-Type', 'text/html; charset=utf-8');
                $pageView = new \Web\Views\Page\GenericView($this, $request, $response);

                if($request->getMethod() !== \phpOMS\Message\RequestMethod::GET) {
                    $response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                    $response->setHeader('Status', 'Status:406 Not acceptable');
                    $response->setStatusCode(406);
                    break;
                }

                if($this->dbPool->get()->getStatus() !== \phpOMS\DataStorage\Database\DatabaseStatus::OK) {
                    $response->setHeader('HTTP', 'HTTP/1.0 503 Service Temporarily Unavailable');
                    $response->setHeader('Status', 'Status: 503 Service Temporarily Unavailable');
                    $response->setHeader('Retry-After', 'Retry-After: 300');
                    $response->setStatusCode(503);

                    $pageView->setTemplate('/Web/Theme/Error/503');
                    break;
                }

                $this->cacheManager   = new \phpOMS\DataStorage\Cache\CacheManager($this->dbPool);
                $this->appSettings    = new \Model\CoreSettings($this->dbPool->get());
                $this->eventManager   = new \phpOMS\Event\EventManager();
                $this->sessionManager = new \phpOMS\DataStorage\Session\HttpSession(36000);
                $this->moduleManager  = new \phpOMS\Module\ModuleManager($this);
                $account              = new \Model\Account(0, $this->dbPool->get(), $this->sessionManager, $this->cacheManager);

                $account->authenticate();
                $aid = $this->accountManager->set($account);
                $request->setAccount($aid);
                $response->setAccount($aid);

                $account->getL11n()->loadCoreLanguage($request->getLanguage());
                $account->getL11n()->loadThemeLanguage($request->getLanguage(), 'backend');

                $head    = $response->getHead();
                $baseUri = $request->getUri()->getBase();

                if($account->getId() < 1) {
                    $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'External/fontawesome/css/font-awesome.min.css');
                    $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'jsOMS/oms.min.js');
                    $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'Web/Theme/backend/js/backend.js');
                    $head->setScript('core', 'var Url = "' . $baseUri . '", assetManager = new jsOMS.AssetManager();');

                    $pageView->setTemplate('/Web/Theme/backend/login');
                    $response->set('GLOBAL', $pageView->render());
                    break;
                }

                $toLoad = $this->moduleManager->getUriLoads($request);

                if(isset($toLoad[4])) {
                    foreach($toLoad[4] as $module) {
                        $this->moduleManager->initModule($module['module_load_file']);
                    }
                }

                $options = $this->appSettings->get([1000000009]);
                $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'Web/Theme/backend/css/backend.css');
                $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'External/fontawesome/css/font-awesome.min.css');
                $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'jsOMS/oms.min.js');
                $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'External/d3/d3.min.js');
                $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'Web/Theme/backend/js/backend.js');
                $head->setStyle('core', file_get_contents(__DIR__ . '/Theme/backend/css/backend-small.css'));
                $head->setScript('core', 'var Url = "' . $baseUri . '", assetManager = new jsOMS.AssetManager();');

                $pageView->setData('Name', $options[1000000009]);
                $pageView->setData('Title', 'Orange Management');
                $pageView->setData('Destination', $request->getRequestDestination());

                $pageView->setTemplate('/Web/Theme/backend/index');
                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->dbPool);
                $pageView->addData('nav', $navigation->nav);
                $response->set('GLOBAL', $pageView->render());
                break;
            case \phpOMS\Message\RequestDestination::API:
                if($this->dbPool->get()->getStatus() !== \phpOMS\DataStorage\Database\DatabaseStatus::OK) {
                    $response->setHeader('HTTP', 'HTTP/1.0 503 Service Temporarily Unavailable');
                    $response->setHeader('Status', 'Status: 503 Service Temporarily Unavailable');
                    $response->setHeader('Retry-After', 'Retry-After: 300');
                    $response->setStatusCode(503);
                    break;
                }

                $this->cacheManager   = new \phpOMS\DataStorage\Cache\CacheManager($this->dbPool);
                $this->appSettings    = new \Model\CoreSettings($this->dbPool->get());
                $this->eventManager   = new \phpOMS\Event\EventManager();
                $this->sessionManager = new \phpOMS\DataStorage\Session\HttpSession(36000);
                $this->moduleManager  = new \phpOMS\Module\ModuleManager($this);
                $account              = new \Model\Account(0, $this->dbPool->get(), $this->sessionManager, $this->cacheManager);

                $account->authenticate();
                $aid = $this->accountManager->set($account);
                $request->setAccount($aid);
                $response->setAccount($aid);

                $response->setHeader('Content-Type', 'application/json; charset=utf-8');
                $response->set('GLOBAL', new \phpOMS\Utils\JsonBuilder());
                $response->get('GLOBAL')->add($request->__toString(), null);

                if(($uris = $request->getUri()->getQuery('r')) !== null) {
                    $uris = json_decode($uris, true);

                    foreach($uris as $key => $uri) {
                        $request->init($uri);
                        $toLoad = $this->moduleManager->getUriLoads($request);

                        if(isset($toLoad[4])) {
                            foreach($toLoad[4] as $module) {
                                $this->moduleManager->initModule($module['module_load_file']);
                            }
                        }

                        /** @noinspection PhpUndefinedMethodInspection */
                        $this->moduleManager->running['Content']->call($request, $response);
                    }
                } else {
                    if($account->getId() < 1) {
                        if($request->getPath(2) === 'login') {
                            $login = $account->login($request->getData('user'), $request->getData('pass'));

                            if($login === \phpOMS\Auth\LoginReturnType::OK) {
                                //$response->get('GLOBAL')->add($request->__toString(), $this->sessionManager->getSID());
                                $response->get('GLOBAL')->add($request->__toString(), (new \Model\Message\Reload())->toArray());
                                $response->set('GLOBAL', $response->get('GLOBAL')->__toString());
                            } else {
                                // TODO: create login failure msg
                            }

                            break;
                        }
                    } else {
                        if($request->getPath(2) === 'logout') {
                            $this->sessionManager->remove('UID');
                            $this->sessionManager->save();
                            $response->get('GLOBAL')->add($request->__toString(), 1);
                            $response->set('GLOBAL', $response->get('GLOBAL')->__toString());
                            break;
                        }
                    }

                    $toLoad = $this->moduleManager->getUriLoads($request);

                    if(isset($toLoad[4])) {
                        foreach($toLoad[4] as $module) {
                            $this->moduleManager->initModule($module['module_load_file']);
                        }
                    }

                    if(($module = $this->moduleManager->get('Content')) !== null) {
                        /** @noinspection PhpUndefinedMethodInspection */
                        $module->call($request, $response);
                    }
                }

                if(!is_string($response_value = $response->get('GLOBAL'))) {
                    $response->set('GLOBAL', $response_value->__toString());
                }
                break;
            case \phpOMS\Message\RequestDestination::REPORTER:
                $response->setHeader('Content-Type', 'text/html; charset=utf-8');
                $pageView = new \Web\Views\Page\GenericView($this, $request, $response);

                if($request->getMethod() !== \phpOMS\Message\RequestMethod::GET) {
                    $response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                    $response->setHeader('Status', 'Status:406 Not acceptable');
                    $response->setStatusCode(406);
                    break;
                }

                if($this->dbPool->get()->getStatus() !== \phpOMS\DataStorage\Database\DatabaseStatus::OK) {
                    $response->setHeader('HTTP', 'HTTP/1.0 503 Service Temporarily Unavailable');
                    $response->setHeader('Status', 'Status: 503 Service Temporarily Unavailable');
                    $response->setHeader('Retry-After', 'Retry-After: 300');
                    $response->setStatusCode(503);

                    $pageView->setTemplate('/Web/Theme/Error/503');
                    break;
                }

                $this->cacheManager   = new \phpOMS\DataStorage\Cache\CacheManager($this->dbPool);
                $this->appSettings    = new \Model\CoreSettings($this->dbPool->get());
                $this->eventManager   = new \phpOMS\Event\EventManager();
                $this->sessionManager = new \phpOMS\DataStorage\Session\HttpSession(36000);
                $this->moduleManager  = new \phpOMS\Module\ModuleManager($this);
                $account              = new \Model\Account(0, $this->dbPool->get(), $this->sessionManager, $this->cacheManager);

                $account->authenticate();
                $aid = $this->accountManager->set($account);
                $request->setAccount($aid);
                $response->setAccount($aid);

                $account->getL11n()->loadCoreLanguage($request->getLanguage());
                $account->getL11n()->loadThemeLanguage($request->getLanguage(), 'reporter');

                $head    = $response->getHead();
                $baseUri = $request->getUri()->getBase();

                if($account->getId() < 1) {
                    $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'External/fontawesome/css/font-awesome.min.css');
                    $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'jsOMS/oms.min.js');
                    $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'Web/Theme/backend/js/backend.js');
                    $head->setScript('core', 'var Url = "' . $baseUri . '", assetManager = new jsOMS.AssetManager();');

                    $pageView->setTemplate('/Web/Theme/backend/login');
                    $response->set('GLOBAL', $pageView->render());
                    break;
                }

                $toLoad = $this->moduleManager->getUriLoads($request);

                if(isset($toLoad[4])) {
                    foreach($toLoad[4] as $module) {
                        $this->moduleManager->initModule($module['module_load_file']);
                    }
                }

                $options = $this->appSettings->get([1000000009]);
                $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'Web/Theme/backend/css/backend.css');
                $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'External/fontawesome/css/font-awesome.min.css');
                $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'jsOMS/oms.min.js');
                $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'External/d3/d3.min.js');
                $head->setStyle('core', file_get_contents(__DIR__ . '/Theme/backend/css/backend-small.css'));
                $head->setScript('core', 'var Url = "' . $baseUri . '", assetManager = new jsOMS.AssetManager();');

                $pageView->setData('Name', $options[1000000009]);
                $pageView->setData('Title', 'Orange Management');
                $pageView->setData('Destination', $request->getRequestDestination());

                $pageView->setTemplate('/Web/Theme/reporter/index');
                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->dbPool);
                $pageView->addData('nav', $navigation->nav);
                $response->set('GLOBAL', $pageView->render());
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');
                $response->setStatusCode(404);

                $pageView = new \phpOMS\Views\View($this, $request, $response);
                $pageView->setTemplate('/Web/Theme/Error/404');
                $response->set('GLOBAL', $pageView->render());
        }

        $response->pushHeader();
        echo $response->render();
    }
}
