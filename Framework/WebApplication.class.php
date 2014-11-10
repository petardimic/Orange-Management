<?php
namespace Framework {
    /**
     * Controller class
     *
     * PHP Version 5.4
     *
     * @category   App
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class WebApplication extends \Framework\ApplicationAbstract {
        /**
         * Theme controller
         *
         * @var \Content\Theme
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
        public function __construct($config) {
            $this->request = new \Framework\Http\Request();
            $this->db      = new \Framework\DataStorage\Database\Database($config['db']);

            \Framework\Module\ModuleFactory::$app = $this;
            \Framework\Model\Model::$app          = $this;

            if ($this->db->status === \Framework\DataStorage\Database\DatabaseStatus::OK) {
                $this->cache    = new \Framework\DataStorage\Cache\Cache($this);
                $this->settings = new \Framework\Config\Settings($this);
                $this->modules  = new \Framework\Module\ModuleManager($this);
                $this->auth     = new \Framework\Auth\Auth($this);
                $this->user     = $this->auth->authenticate();

                $this->settings->load_settings([1000000011]);

                \Framework\Model\Model::$content['page:addr:url']    = 'http://' . $config['page'][0];
                \Framework\Model\Model::$content['page:addr:local']  = 'http://' . $config['page'][0];
                \Framework\Model\Model::$content['page:addr:remote'] = 'http://' . $config['page'][1];

                include __DIR__ . '/../Content/Themes' . $this->settings->config[1000000011] . '/Theme.class.php';
                $this->theme = new \Content\Theme($this);
            } else {
                header('HTTP/1.0 503 Service Temporarily Unavailable');
                header('Status: 503 Service Temporarily Unavailable');
                header('Retry-After: 300');
                include __DIR__ . '/../Content/Error/503.php';
            }
        }
    }
}
