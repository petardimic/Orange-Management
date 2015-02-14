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
class WebApplication extends \Framework\ApplicationAbstract
{
    /**
     * Main request
     *
     * @var \Framework\Message\Http\Request
     * @since 1.0.0
     */
    public $request = null;

    /**
     * Main request
     *
     * @var \Framework\Message\Http\Response
     * @since 1.0.0
     */
    public $response = null;

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
        $this->request  = new \Framework\Message\Http\Request();
        $this->request->init();
        $this->response = new \Framework\Message\Http\Response();

        $this->dbPool = new \Framework\DataStorage\Database\Pool();
        $this->dbPool->create('core', $config['db']);

        $this->cache    = new \Framework\DataStorage\Cache\Cache($this->dbPool);
        $this->settings = new \Framework\Config\Settings($this->dbPool);

        $pageView = null;

        switch($this->request->getType()) {
            case \Framework\Message\Http\WebRequestPage::WEBSITE:

                break;
            case \Framework\Message\Http\WebRequestPage::BACKEND:
                if($this->request->getRequestType() !== \Framework\Message\RequestType::GET) {
                    $this->response->addHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                    $this->response->addHeader('Status', 'Status:406 Not acceptable');
                    $this->response->add('GLOBAL', '');
                    break;
                }

                $this->response->addHeader('Content-Type', 'Content-Type: text/html; charset=utf-8');

                $pageView = new \Web\Views\Page\BackendView();

                if($this->dbPool->get('core')->status !== \Framework\DataStorage\Database\DatabaseStatus::OK) {
                    $this->dbFailResponse($pageView);
                    break;
                }

                \Framework\Module\ModuleFactory::$app = $this;
                \Framework\Model\Model::$app          = $this;

                $this->eventManager   = new \Framework\Event\EventManager();
                $this->sessionManager = new \Framework\DataStorage\Session\HttpSession();
                $this->moduleManager  = new \Framework\Module\ModuleManager($this->dbPool);
                $this->auth           = new \Framework\Auth\Http($this->dbPool, $this->sessionManager);
                $this->user           = $this->auth->authenticate();

                $this->user->getL11n()->loadCoreLanguage($this->request->getLanguage());
                $this->user->getL11n()->loadThemeLanguage($this->request->getLanguage(), 'backend');

                $pageView->setLocalization($this->user->getL11n());
                $pageView->setRequest($this->request);
                $pageView->setResponse($this->response);

                if($this->user->getId() < 1) {
                    $pageView->setTemplate('/Web/Theme/backend/login');
                    $this->response->add('GLOBAL', $pageView->getOutput());
                    break;
                }

                $toLoad = $this->moduleManager->getUriLoads($this->request);

                if(isset($toLoad[4])) {
                    foreach($toLoad[4] as $module) {
                        \Framework\Module\ModuleFactory::getInstance($module['file']);
                    }
                }

                if(isset($toLoad[5])) {
                    $this->user->getL11n()->loadLanguage($this->request->getLanguage(), $toLoad[5], $this->moduleManager->getActiveModules());
                }

                $this->settings->loadSettings([1000000011, 1000000009]);
                \Framework\Model\Model::$content['page:addr:url']    = 'http://127.0.0.1';
                \Framework\Model\Model::$content['page:addr:local']  = 'http://127.0.0.1';
                \Framework\Model\Model::$content['page:addr:remote'] = 'http://127.0.0.1';
                \Framework\Model\Model::$content['core:oname']       = $this->settings->config[1000000009];
                \Framework\Model\Model::$content['theme:path']       = $this->settings->config[1000000011];
                \Framework\Model\Model::$content['core:layout']      = $this->request->getType();
                \Framework\Model\Model::$content['page:title']       = 'Orange Management';

                $pageView->setTemplate('/Web/Theme/backend/index');
                $navigation = \Modules\Navigation\Models\Navigation::getInstance($this->request->getHash(), $this->dbPool);
                $pageView->addData('nav', $navigation->nav);
                $this->response->add('GLOBAL', $pageView->getOutput());
                break;
            case \Framework\Message\Http\WebRequestPage::API:
                if($this->dbPool->get('core')->status !== \Framework\DataStorage\Database\DatabaseStatus::OK) {
                    $this->response->addHeader('HTTP', 'HTTP/1.0 503 Service Temporarily Unavailable');
                    $this->response->addHeader('Status', 'Status: 503 Service Temporarily Unavailable');
                    $this->response->addHeader('Retry-After', 'Retry-After: 300');
                    $this->response->add('GLOBAL', '');
                    break;
                }

                \Framework\Module\ModuleFactory::$app = $this;
                \Framework\Model\Model::$app          = $this;

                $this->eventManager   = new \Framework\Event\EventManager();
                $this->sessionManager = new \Framework\DataStorage\Session\HttpSession();
                $this->moduleManager  = new \Framework\Module\ModuleManager($this->dbPool);
                $this->auth           = new \Framework\Auth\Http($this->dbPool, $this->sessionManager);
                $this->user           = $this->auth->authenticate();

                $this->response->addHeader('Content-Type', 'Content-Type: application/json; charset=utf-8');
                $this->response->add('GLOBAL', new \Framework\Utils\JsonBuilder());

                $this->response->get('GLOBAL')->add($this->request->__toString(), null);

                $request = new \Framework\Message\Http\Request();

                if(($uris = $this->request->getData('r')) !== false) {
                    $uris = json_decode($uris, true);

                    foreach($uris as $key => $uri) {
                        $request->init($uri);
                        $toLoad = $this->moduleManager->getUriLoads($request);

                        if(isset($toLoad[4])) {
                            foreach($toLoad[4] as $module) {
                                \Framework\Module\ModuleFactory::getInstance($module['file']);
                            }
                        }

                        if(isset($toLoad[5])) {
                            $this->user->getL11n()->loadLanguage($request->getLanguage(), $toLoad[5], $this->moduleManager->getActiveModules());
                        }

                        /** @noinspection PhpUndefinedMethodInspection */
                        $this->moduleManager->running['Content']->call(\Framework\Module\CallType::WEB, $request, $this->response);
                    }
                } else {
                    $request = $this->request;

                    if($this->user->getId() < 1) {
                        if($request->getData()['l2'] === 'login') {
                            $this->sessionManager->set('UID', 1);
                            $this->sessionManager->save();

                            $this->response->get('GLOBAL')->add($this->request->__toString(), $this->sessionManager->getSID());
                            $this->response->add('GLOBAL', $this->response->get('GLOBAL')->__toString());
                            break;
                        }
                    } else {
                        if($request->getData()['l2'] === 'logout') {
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
                            \Framework\Module\ModuleFactory::getInstance($module['file']);
                        }
                    }

                    if(isset($toLoad[5])) {
                        $this->user->getL11n()->loadLanguage($this->request->getLanguage(), $toLoad[5], $this->moduleManager->getActiveModules());
                    }

                    if(isset(\Framework\Module\ModuleFactory::$loaded['Content'])) {
                        /** @noinspection PhpUndefinedMethodInspection */
                        \Framework\Module\ModuleFactory::$loaded['Content']->call(\Framework\Module\CallType::WEB, $this->request, $this->response);
                    }
                }

                $this->response->add('GLOBAL', $this->response->get('GLOBAL')->__toString());
                break;
            default:
                $this->response->addHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $this->response->addHeader('Status', 'Status: 404 Not Found');

                $pageView = new \Framework\Views\ViewAbstract();
                $pageView->setTemplate('/Web/Theme/Error/404');
                $this->response->add('GLOBAL', $pageView->getOutput());
        }

        echo $this->response->make('GLOBAL');
    }

    /**
     * Generate visual database error
     *
     * @param \Framework\Views\ViewAbstract $view View
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function dbFailResponse(&$view)
    {
        $this->response->addHeader('HTTP', 'HTTP/1.0 503 Service Temporarily Unavailable');
        $this->response->addHeader('Status', 'Status: 503 Service Temporarily Unavailable');
        $this->response->addHeader('Retry-After', 'Retry-After: 300');
        $this->response->add('GLOBAL', '');

        $view->setTemplate('/Web/Theme/Error/503');
    }
}
