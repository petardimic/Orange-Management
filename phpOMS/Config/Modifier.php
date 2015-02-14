<?php
namespace phpOMS\Config;

/**
 * Config modifer class
 *
 * Responsible for editing the server and core configuration for this software.
 * This only includes the core config.conf file and nothing else.
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Config
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Modifier
{
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
     * @param string $file File path
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($file)
    {
        $this->file = $file;

        include __DIR__ . '/../../config.php';

        /** @var array $CONFIG */
        $this->config['db'] = $CONFIG['db'];
        /** @var array $PAGE */
        $this->config['page'] = $CONFIG['page'];
    }

    /**
     * Creating config file
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function writeConfig()
    {
        $output = '<' . '?php' . PHP_EOL
            .= '/**' . PHP_EOL
            .= ' * Global config file' . PHP_EOL
            .= ' *' . PHP_EOL
            .= ' * @category   Config' . PHP_EOL
            .= ' * @package    Framework' . PHP_EOL
            .= ' * @author     OMS Development Team <dev@oms.com>' . PHP_EOL
            .= ' * @author     Dennis Eichhorn <d.eichhorn@oms.com>' . PHP_EOL
            .= ' * @copyright  2013' . PHP_EOL
            .= ' * @license    OMS License 1.0' . PHP_EOL
            .= ' * @version    1.0.0' . PHP_EOL
            .= ' * @link       http://orange-management.com' . PHP_EOL
            .= ' * @since      1.0.0' . PHP_EOL
            .= ' */' . PHP_EOL . PHP_EOL
            .= '$CONFIG = [ "db" => [' . PHP_EOL
            .= '"db" => "' . $this->config['db']['db'] . '"' . PHP_EOL
            .= '"host" => "' . $this->config['db']['host'] . '"' . PHP_EOL
            .= '"login" => "' . $this->config['db']['login'] . '"' . PHP_EOL
            .= '"password" => "' . $this->config['db']['password'] . '"' . PHP_EOL
            .= '"database" => "' . $this->config['db']['database'] . '"' . PHP_EOL
            .= '"prefix" => "' . $this->config['db']['prefix'] . '"' . PHP_EOL
            .= '],' . PHP_EOL
            .= '"page" => [' . PHP_EOL
            .= '"' . $this->config['page'][0] . '"' . PHP_EOL
            .= '"' . $this->config['page'][1] . '"' . PHP_EOL
            .= '"' . $this->config['page'][2] . '"' . PHP_EOL
            .= ']];';

        file_put_contents($this->file, $output);
    }
}