<?php
namespace phpOMS\Console;

/**
 * Commands class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Console
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Commands implements \Countable
{
    /**
     * Commands
     *
     * @var mixed[]
     * @since 1.0.0
     */
    private $commands = [];

    /**
     * Commands
     *
     * @var int
     * @since 1.0.0
     */
    private $count = 0;

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
    }

    /**
     * Attach new command
     *
     * @param string $cmd      Command ID
     * @param mixed  $callback Function callback
     * @param mixed  $source   Provider
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function attach($cmd, $callback, $source)
    {
        $this->commands[$cmd] = [$callback, $source];
        $this->count++;
    }

    /**
     * Detach existing command
     *
     * @param string $cmd    Command ID
     * @param mixed  $source Provider
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function detach($cmd, $source)
    {
        if(array_key_exists($cmd, $this->commands)) {
            unset($this->commands[$cmd]);
            $this->count--;
        }
    }

    /**
     * Detach existing command
     *
     * @param string $cmd  Command ID
     * @param mixed  $para Parameters to pass
     *
     * @return \phpOMS\Message\ResponseStatus::WRONG_REQUEST|mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function trigger($cmd, $para)
    {
        if(array_key_exists($cmd, $this->commands)) {
            return $this->commands[$cmd][0]($para);
        }

        return \phpOMS\Message\ResponseStatus::WRONG_REQUEST;
    }

    /**
     * Count commands
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function count()
    {
        return $this->count;
    }
}