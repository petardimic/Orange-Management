<?php
namespace phpOMS\Message;

/**
 * Request class
 *
 * @todo       : to i really need the interface or should i just define these function as abstract public function blabla();
 *
 * PHP Version 5.4
 *
 * @property mixed request
 *
 * @category   Request
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class RequestAbstract implements \phpOMS\Message\RequestInterface
{

// region Class Fields
    /**
     * Uri
     *
     * @var \phpOMS\Uri\UriInterface
     * @since 1.0.0
     */
    public $uri = null;

    /**
     * Request type
     *
     * @var \phpOMS\Message\RequestMethod
     * @since 1.0.0
     */
    protected $type = null;

    /**
     * Request data
     *
     * @var array
     * @since 1.0.0
     */
    protected $data = null;

    /**
     * Request data
     *
     * @var array
     * @since 1.0.0
     */
    protected $path = [];

    /**
     * Language
     *
     * @var string
     * @since 1.0.0
     */
    protected $lang = null;

    /**
     * Account
     *
     * @var mixed
     * @since 1.0.0
     */
    protected $account = null;

    /**
     * Request type
     *
     * @var \phpOMS\Message\RequestSource
     * @since 1.0.0
     */
    private static $source = null;
// endregion

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
     * {@inheritdoc}
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestSource()
    {
        return self::$source;
    }

    /**
     * {@inheritdoc}
     */
    public function setRequestSource($source)
    {
        self::$source = $source;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getMethod();

    /**
     * {@inheritdoc}
     */
    public function getPath($key = null)
    {
        if($key === null) {
            return $this->path;
        }

        return (isset($this->path[$key]) ? $this->path[$key] : null);
    }

    /**
     * {@inheritdoc}
     */
    public function getData($key = null)
    {
        if($key === null) {
            return $this->data;
        }

        return (isset($this->data[$key]) ? $this->data[$key] : null);
    }

    /**
     * {@inheritdoc}
     */
    public function setData($key, $value, $overwrite = true)
    {
        if($overwrite || !isset($this->data[$key])) {
            $this->data[$key] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguage()
    {
        return $this->lang;
    }

    public function setAccount($account) {
        $this->account = $account;
    }

    public function getAccount() {
        return $this->account;
    }
}