<?php
namespace Web\Backend;

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
class Application
{

    /**
     * WebApplication
     *
     * @var \Web\WebApplication
     * @since 1.0.0
     */
    private $app = null;

    /**
     * Config
     *
     * @var array
     * @since 1.0.0
     */
    private $config = null;

    /**
     * Constructor
     *
     * @param \Web\WebApplication           $app      WebApplication
     * @param \phpOMS\Message\Http\Request  $request  Http request
     * @param \phpOMS\Message\Http\Response $response Http response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app, $config)
    {
        $this->app    = $app;
        $this->config = $config;
    }

    /**
     * Rendering backend
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function run($request, $response)
    {
        if($this->app->dbPool->get()->getStatus() !== \phpOMS\DataStorage\Database\DatabaseStatus::OK) {
            $response->setHeader('HTTP', 'HTTP/1.0 503 Service Temporarily Unavailable');
            $response->setHeader('Status', 'Status: 503 Service Temporarily Unavailable');
            $response->setHeader('Retry-After', 'Retry-After: 300');
            $response->setStatusCode(503);

            $pageView->setTemplate('/Web/Backend/Error/503');
            $response->set('Content', $pageView->render());

            return;
        }

        $options = $this->app->appSettings->get([1000000009]);
        $account = $app->app->accountManager->get($request->getAccount());
        $response->setLanguage(!in_array($account->getL11n()->getLanguage(), $this->config['language']) ? $options[1] : $account->getL11n()->getLanguage());

        if(($uris = $request->getUri()->getQuery('r')) !== null) {
            $request_r = clone $request;
            $uris      = json_decode($uris, true);

            foreach($uris as $key => $uri) {
                $request_r->init($uri);

                $modules = $this->app->moduleManager->getRoutedModules($request_r);
                $this->app->moduleManager->initModule($modules);
                $this->app->moduleManager->loadLanguage($response->getLanguage(), 'backend');

                $this->disptacher($this->router->route($this->request_r->getRoutify()), $request_r, $response, null);
            }
        } else {
            if($request->getPath(2) === 'login' && $account->getId() < 1) {
                $login = $account->login($request->getData('user'), $request->getData('pass'));

                if($login === \phpOMS\Auth\LoginReturnType::OK) {
                    $response->get('Content')->add($request->__toString(), (new \Model\Message\Reload())->toArray());
                    $response->set('Content', $response->get('Content')->__toString());
                } else {
                    // TODO: create login failure msg
                }

                return;
            } elseif($request->getPath(2) === 'logout') {
                $this->app->sessionManager->remove('UID');
                $this->app->sessionManager->save();
                $response->get('Content')->add($request->__toString(), 1);
                $response->set('Content', $response->get('Content')->__toString());

                return;
            }

            $modules = $this->app->moduleManager->getRoutedModules();
            $this->app->moduleManager->initModule($modules);
            $this->app->moduleManager->loadLanguage($response->getLanguage(), 'api');

            $this->disptacher($this->router->route($this->request->getRoutify()), $request, $response, null);
        }
    }
}
