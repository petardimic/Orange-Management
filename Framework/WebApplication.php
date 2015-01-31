<?php
namespace Framework;

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
     * Theme controller
     *
     * @var \Web\Theme\Theme
     * @since 1.0.0
     */
    private $theme = null;

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
        $this->request = new \Framework\Message\Http\Request();
        $this->dbPool  = new \Framework\DataStorage\Database\Pool();
        $this->dbPool->create('core', $config['db']);

        \Framework\Module\ModuleFactory::$app = $this;
        \Framework\Model\Model::$app          = $this;

        if($this->dbPool->get('core')->status === \Framework\DataStorage\Database\DatabaseStatus::OK) {
            $this->cache    = new \Framework\DataStorage\Cache\Cache($this);
            $this->settings = new \Framework\Config\Settings($this);
            $this->session  = new \Framework\DataStorage\Session\Session();
            $this->modules  = new \Framework\Module\ModuleManager($this);
            $this->event    = new \Framework\Event\EventManager();
            $this->auth     = new \Framework\Auth\Http($this);
            $this->user     = $this->auth->authenticate();

            $toLoad = $this->modules->getUriLoads($this->request);

            if(isset($toLoad[4])) {
                foreach($toLoad[4] as $module) {
                    \Framework\Module\ModuleFactory::getInstance($module['file']);
                }
            }

            if(isset($toLoad[5])) {
                $this->user->localization->loadLanguage($this->request->getLanguage(), $toLoad[5]);
            }

            /* TODO: change */
            $this->settings->loadSettings([1000000011]);
            \Framework\Model\Model::$content['page:addr:url']    = 'http://127.0.0.1';
            \Framework\Model\Model::$content['page:addr:local']  = 'http://127.0.0.1';
            \Framework\Model\Model::$content['page:addr:remote'] = 'http://127.0.0.1';

            $this->theme = new \Web\Theme\Theme($this);
        } else {
            header('HTTP/1.0 503 Service Temporarily Unavailable');
            header('Status: 503 Service Temporarily Unavailable');
            header('Retry-After: 300');

            // TODO: inform admin

            include __DIR__ . '/../Web/Theme/Error/503.php';
        }
    }
}
