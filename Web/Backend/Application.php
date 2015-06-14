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
     * @param \phpOMS\Message\Http\Request  $request  Request
     * @param \phpOMS\Message\Http\Resposne $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function run($request, $response)
    {
        $response->setHeader('Content-Type', 'text/html; charset=utf-8');
        $pageView = new \Web\Views\Page\GenericView($this->app, $request, $response);

        if($request->getMethod() !== \phpOMS\Message\RequestMethod::GET) {
            $response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
            $response->setHeader('Status', 'Status:406 Not acceptable');
            $response->setStatusCode(406);

            $pageView->setTemplate('/Web/Backend/Error/406');
            $response->set('Content', $pageView->render());

            return;
        }

        if($this->app->dbPool->get()->getStatus() !== \phpOMS\DataStorage\Database\DatabaseStatus::OK) {
            $response->setHeader('HTTP', 'HTTP/1.0 503 Service Temporarily Unavailable');
            $response->setHeader('Status', 'Status: 503 Service Temporarily Unavailable');
            $response->setHeader('Retry-After', 'Retry-After: 300');
            $response->setStatusCode(503);

            $pageView->setTemplate('/Web/Backend/Error/503');
            $response->set('Content', $pageView->render());

            return;
        }

        $options = $this->app->appSettings->get([1000000009, 1000000029]);
        $account = $this->app->accountManager->get($request->getAccount());

        $l11n = new \phpOMS\Localization\Localization();
        $l11n->setLanguage(!in_array($request->getLanguage(), $this->config['language']) ? $options[1000000029] : $request->getLanguage());
        $l11n->setLang($this->app->l11nManager->getLang($response->getLanguage()));
        $account->setL11n($l11n);
        $response->setL11n($l11n);

        include __DIR__ . '/lang/' . $account->getL11n()->getLanguage() . '.lang.php';
        $this->app->l11nManager->loadLanguage($response->getLanguage(), 'CORE', $THEMELANG);

        $head    = $response->getHead();
        $baseUri = $request->getUri()->getBase();

        if($account->getId() < 1) {
            $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'External/fontawesome/css/font-awesome.min.css');
            $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'jsOMS/oms.min.js');
            $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'Web/Theme/Backend/js/backend.js');
            $head->setScript('core', 'var Url = "' . $baseUri . '", assetManager = new jsOMS.AssetManager();');

            $pageView->setTemplate('/Web/Backend/login');
            $response->set('Content', $pageView->render());

            return;
        }

        $modules = $this->app->moduleManager->getRoutedModules();
        $this->app->moduleManager->initModule($modules);
        $this->app->moduleManager->loadLanguage($response->getLanguage(), 'backend');

        $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'Web/Theme/Backend/css/backend.css');
        $head->addAsset(\phpOMS\Asset\AssetType::CSS, $baseUri . 'External/fontawesome/css/font-awesome.min.css');
        $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'jsOMS/oms.min.js');
        $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'External/d3/d3.min.js');
        $head->addAsset(\phpOMS\Asset\AssetType::JS, $baseUri . 'Web/Theme/Backend/js/backend.js');
        $head->setStyle('core', file_get_contents(__DIR__ . '/Theme/Backend/css/backend-small.css'));
        $head->setScript('core', 'var Url = "' . $baseUri . '", assetManager = new jsOMS.AssetManager();');

        $pageView->setData('Name', $options[1000000009]);
        $pageView->setData('Title', 'Orange Management');
        $pageView->setData('Destination', $request->getRequestDestination());

        $this->disptacher($this->router->route($this->request->getRoutify()), $request, $response, null);

        $pageView->setTemplate('/Web/Theme/Backend/index');
        $response->set('Content', $pageView->render());
    }
}
