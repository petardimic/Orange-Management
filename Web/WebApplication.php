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
        $this->request  = new \phpOMS\Message\Http\Request();
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
                    $this->response->add('GLOBAL', '');
                    break;
                }

                $this->response->setHeader('Content-Type', 'Content-Type: text/html; charset=utf-8');

                $pageView = new \Web\Views\Page\BackendView();

                if($this->dbPool->get('core')->getStatus() !== \phpOMS\DataStorage\Database\DatabaseStatus::OK) {
                    $this->dbFailResponse($pageView);
                    break;
                }

                $this->setupBasic();

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
                        \phpOMS\Module\ModuleFactory::getInstance($module['file']);
                    }
                }

                if(isset($toLoad[5])) {
                    $this->user->getL11n()->loadLanguage($this->request->getLanguage(), $toLoad[5], $this->moduleManager->getActiveModules());
                }

                $this->settings->get([1000000011, 1000000009]);
                \phpOMS\Model\Model::$content['page:addr:url']    = 'http://127.0.0.1';
                \phpOMS\Model\Model::$content['page:addr:local']  = 'http://127.0.0.1';
                \phpOMS\Model\Model::$content['page:addr:remote'] = 'http://127.0.0.1';
                \phpOMS\Model\Model::$content['core:oname']       = $this->settings->config[1000000009];
                \phpOMS\Model\Model::$content['theme:path']       = $this->settings->config[1000000011];
                \phpOMS\Model\Model::$content['core:layout']      = $this->request->getRequestDestination();
                \phpOMS\Model\Model::$content['page:title']       = 'Orange Management';

                $pageView->setTemplate('/Web/Theme/backend/index');
                $navigation = \Modules\Navigation\Models\Navigation::getInstance($this->request->getHash(), $this->dbPool);
                $pageView->addData('nav', $navigation->nav);
                $this->response->add('GLOBAL', $pageView->getOutput());
                break;
            case \phpOMS\Message\RequestDestination::API:
                if($this->dbPool->get('core')->getStatus() !== \phpOMS\DataStorage\Database\DatabaseStatus::OK) {
                    $this->response->setHeader('HTTP', 'HTTP/1.0 503 Service Temporarily Unavailable');
                    $this->response->setHeader('Status', 'Status: 503 Service Temporarily Unavailable');
                    $this->response->setHeader('Retry-After', 'Retry-After: 300');
                    $this->response->add('GLOBAL', '');
                    break;
                }

                $this->setupBasic();

                $this->response->setHeader('Content-Type', 'Content-Type: application/json; charset=utf-8');
                $this->response->add('GLOBAL', new \phpOMS\Utils\JsonBuilder());

                $this->response->get('GLOBAL')->add($this->request->__toString(), null);

                $request = new \phpOMS\Message\Http\Request();

                if(($uris = $this->request->getData('r')) !== false) {
                    $uris = json_decode($uris, true);

                    foreach($uris as $key => $uri) {
                        $request->init($uri);
                        $toLoad = $this->moduleManager->getUriLoads($request);

                        if(isset($toLoad[4])) {
                            foreach($toLoad[4] as $module) {
                                \phpOMS\Module\ModuleFactory::getInstance($module['file']);
                            }
                        }

                        if(isset($toLoad[5])) {
                            $this->user->getL11n()->loadLanguage($request->getLanguage(), $toLoad[5], $this->moduleManager->getActiveModules());
                        }

                        /** @noinspection PhpUndefinedMethodInspection */
                        $this->moduleManager->running['Content']->call(\phpOMS\Message\RequestSource::WEB, $request, $this->response);
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
                            \phpOMS\Module\ModuleFactory::getInstance($module['file']);
                        }
                    }

                    if(isset($toLoad[5])) {
                        $this->user->getL11n()->loadLanguage($this->request->getLanguage(), $toLoad[5], $this->moduleManager->getActiveModules());
                    }

                    if(isset(\phpOMS\Module\ModuleFactory::$loaded['Content'])) {
                        /** @noinspection PhpUndefinedMethodInspection */
                        \phpOMS\Module\ModuleFactory::$loaded['Content']->call(\phpOMS\Message\RequestSource::WEB, $this->request, $this->response);
                    }
                }

                $this->response->add('GLOBAL', $this->response->get('GLOBAL')->__toString());
                break;
            default:
                $this->response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $this->response->setHeader('Status', 'Status: 404 Not Found');

                $pageView = new \phpOMS\Views\View();
                $pageView->setTemplate('/Web/Theme/Error/404');
                $this->response->add('GLOBAL', $pageView->getOutput());
        }

        echo $this->response->make('GLOBAL');
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
        $this->response->add('GLOBAL', '');

        $view->setTemplate('/Web/Theme/Error/503');
    }

    /**
     * Setup basic instances
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function setupBasic() {
        $this->cache    = new \phpOMS\DataStorage\Cache\Cache($this->dbPool);
        $this->settings = new \Model\CoreSettings($this->dbPool->get('core'));

        \phpOMS\Module\ModuleFactory::$app = $this;
        \phpOMS\Model\Model::$app          = $this;

        $this->eventManager   = new \phpOMS\Event\EventManager();
        $this->sessionManager = new \phpOMS\DataStorage\Session\HttpSession(36000);
        $this->moduleManager  = new \phpOMS\Module\ModuleManager($this->dbPool);
        $this->user           = new \Model\Account($this->dbPool->get('core'), $this->sessionManager, $this->cache);
        $this->user->authenticate();
    }
}
