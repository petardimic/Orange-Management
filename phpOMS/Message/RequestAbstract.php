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
     * Language
     *
     * @var string
     * @since 1.0.0
     */
    protected $lang = null;

    /**
     * Request type
     *
     * @var \phpOMS\Message\RequestSource
     * @since 1.0.0
     */
    private static $source = null;

    /** @todo: implement!!! */
    protected $scheme   = null;

    protected $host     = null;

    protected $port     = 80;

    protected $user     = 80;

    protected $password = 80;

    protected $path     = null;

    protected $query    = null;

    protected $fragment = null;
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
    public function getHost()
    {
        return $this->host;
    }

    /**
     * {@inheritdoc}
     */
    public function getScheme()
    {
        return $this->scheme;
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
    public function getRequest($key = null)
    {
        if($key === null) {
            return $this->data;
        }

        return (isset($this->data[$key]) ? $this->data[$key] : false);
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguage()
    {
        return $this->lang;
    }
}