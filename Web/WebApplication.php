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
     *                      ø
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($config)
    {
        $response = new \phpOMS\Message\Http\Response();

        try {
            $request      = new \phpOMS\Message\Http\Request($config['page']['root']);
            $this->dbPool = new \phpOMS\DataStorage\Database\Pool();

            $request->init();
            $this->dbPool->create('core', $config['db']);

            $this->cacheManager   = new \phpOMS\DataStorage\Cache\CacheManager($this->dbPool);
            $this->appSettings    = new \Model\CoreSettings($this->dbPool->get());
            $this->eventManager   = new \phpOMS\Event\EventManager();
            $this->router         = new \phpOMS\Router\Router();
            $this->sessionManager = new \phpOMS\DataStorage\Session\HttpSession(36000);
            $this->moduleManager  = new \phpOMS\Module\ModuleManager($this);
            $this->l11nManager    = new \phpOMS\Localization\L11nManager();
            $this->accountManager = new \phpOMS\Account\AccountManager();
            $account              = new \Model\Account(0, $this->dbPool->get(), $this->sessionManager, $this->cacheManager);
            $account->authenticate();
            $aid = $this->accountManager->set($account);
            $request->setAccount($aid);
            $response->setAccount($aid);

            switch($request->getRequestDestination()) {
                case \phpOMS\Message\RequestDestination::API:
                    $sub = new \Web\Api\Application($this, $config);
                    $sub->run($request, $response);
                    break;
                case \phpOMS\Message\RequestDestination::BACKEND:
                    $sub = new \Web\Backend\Application($this, $config);
                    $sub->run($request, $response);
                    break;
                case \phpOMS\Message\RequestDestination::REPORTER:
                    $sub = new \Web\Reporter\Application($this, $config);
                    $sub->run($request, $response);
                    break;
                default:
                    $sub = new \Web\E404\Application($this, $config);
                    $sub->run($request, $response);
                    break;
            }
        } catch(\Exception $e) {
            $sub = new \Web\E500\Application($this, $config);
            $sub->run($request, $response);
        } finally {
            switch($response->getHeader('Content-Type')) {
                case \phpOMS\System\MimeType::M_HTML:
                    echo $response->render();
                    break;
                case \phpOMS\System\MimeType::M_JSON:
                    echo $response->toJson();
                    break;
                case \phpOMS\System\MimeType::M_PDF:
                    break;
                case \phpOMS\System\MimeType::M_CONF:
                    echo $response->toCsv();
                    break;
                case \phpOMS\System\MimeType::M_CSV:
                    break;
                default:
                    echo $response->render();
                    break;
            }
        }
    }
}
