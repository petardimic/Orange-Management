<?php
namespace Socket;

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
class SocketApplication extends \phpOMS\ApplicationAbstract
{

// region Class Fields
    /**
     * Socket type
     *
     * @var \phpOMS\Socket\SocketType
     * @since 1.0.0
     */
    private $type;

// endregion

    /**
     * Constructor
     *
     * @param array $config Core config
     * @param int   $type   Socket type
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($config, $type)
    {
        $this->type = $type;
        $socket     = null;

        if($type === \phpOMS\Socket\SocketType::SERVER) {
            $this->dbPool = new \phpOMS\DataStorage\Database\Pool();
            $this->dbPool->create('core', $config['db']);

            $this->cacheManager   = new \phpOMS\DataStorage\Cache\CacheManager($this->dbPool);
            $this->appSettings    = new \Model\CoreSettings($this->dbPool->get());
            $this->eventManager   = new \phpOMS\Event\EventManager();
            $this->sessionManager = new \phpOMS\DataStorage\Session\SocketSession(36000);
            $this->moduleManager  = new \phpOMS\Module\ModuleManager($this);

            $modules = $this->moduleManager->getActiveModules();
            foreach($modules as $module) {
                $this->moduleManager->initModule($module['module_name']);
            }

            $socket = new \phpOMS\Socket\Server\Server($this);
            $socket->create('127.0.0.1', $config['socket']['port']);
            $socket->setLimit($config['socket']['limit']);
        } elseif($type === \phpOMS\Socket\SocketType::CLIENT) {
            $socket = new \phpOMS\Socket\Client\Client();
            $socket->create('127.0.0.1', $config['socket']['port']);
        } else {
            exit('Unknown socket type');
        }

        $socket->run();
    }
}
