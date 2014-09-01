<?php
namespace Framework\Config {
    /**
     * Group class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class ConfigModifier {

        /**
         * Config file
         *
         * @var string
         * @since 1.0.0
         */
        private $file = null;

        /**
         * Config values
         *
         * @var string[]
         * @since 1.0.0
         */
        public $config = [];

        /**
         * Constructor
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($file) {
            $this->file = $file;

            include __DIR__ . '/../../config.php';

            /** @var array $DBDATA */
            $this->config['DBDATA'] = $DBDATA;
            /** @var array $PAGE */
            $this->config['PAGE'] = $PAGE;
        }

        public function write_config() {
            $output = '<' . '?php' . PHP_EOL
                .= '/**' . PHP_EOL
                .= ' * Global config file' . PHP_EOL
                .= ' *' . PHP_EOL
                .= ' * @category   Base' . PHP_EOL
                .= ' * @package    OMS Core' . PHP_EOL
                .= ' * @author     OMS Development Team <dev@oms.com>' . PHP_EOL
                .= ' * @author     Dennis Eichhorn <d.eichhorn@oms.com>' . PHP_EOL
                .= ' * @copyright  2013' . PHP_EOL
                .= ' * @license    OMS License 1.0' . PHP_EOL
                .= ' * @version    1.0.0' . PHP_EOL
                .= ' * @link       http://orange-management.com' . PHP_EOL
                .= ' * @since      1.0.0' . PHP_EOL
                .= ' */' . PHP_EOL . PHP_EOL
                .= '$DBDATA = [' . PHP_EOL
                .= '"db" => "' . $this->config['DBDATA']['db'] . '"' . PHP_EOL
                .= '"host" => "' . $this->config['DBDATA']['host'] . '"' . PHP_EOL
                .= '"login" => "' . $this->config['DBDATA']['login'] . '"' . PHP_EOL
                .= '"password" => "' . $this->config['DBDATA']['password'] . '"' . PHP_EOL
                .= '"database" => "' . $this->config['DBDATA']['database'] . '"' . PHP_EOL
                .= '"prefix" => "' . $this->config['DBDATA']['prefix'] . '"' . PHP_EOL
                .= '];' . PHP_EOL . PHP_EOL
                .= '$PAGE = [' . PHP_EOL
                .= '"' . $this->config['PAGE'][0] . '"' . PHP_EOL
                .= '"' . $this->config['PAGE'][1] . '"' . PHP_EOL
                .= '"' . $this->config['PAGE'][2] . '"' . PHP_EOL
                .= '];';

            file_put_contents($this->file, $output);
        }
    }
}