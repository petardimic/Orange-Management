<?php
namespace phpOMS\Uri;

/**
 * Uri interface
 *
 * Used in order to create and evaluate a uri
 *
 * PHP Version 5.4
 *
 * @category   Uri
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Http implements \phpOMS\Uri\UriInterface
{

// region Class Fields
    /**
     * Root path
     *
     * @var string
     * @since 1.0.0
     */
    private $rootPath = '';

    /**
     * Uri
     *
     * @var string
     * @since 1.0.0
     */
    private $uri = null;

    /**
     * Uri scheme
     *
     * @var string
     * @since 1.0.0
     */
    private $scheme = null;

    /**
     * Uri host
     *
     * @var string
     * @since 1.0.0
     */
    private $host = null;

    /**
     * Uri port
     *
     * @var int
     * @since 1.0.0
     */
    private $port = 80;

    /**
     * Uri user
     *
     * @var string
     * @since 1.0.0
     */
    private $user = '';

    /**
     * Uri password
     *
     * @var string
     * @since 1.0.0
     */
    private $pass = '';

    /**
     * Uri path
     *
     * @var string
     * @since 1.0.0
     */
    private $path = null;

    /**
     * Uri query
     *
     * @var string
     * @since 1.0.0
     */
    private $query = null;

    /**
     * Uri fragment
     *
     * @var string
     * @since 1.0.0
     */
    private $fragment = null;

    /**
     * Uri base
     *
     * @var string
     * @since 1.0.0
     */
    private $base = '';
// endregion

    /**
     * Constructor
     *
     * @param string $rootPath Root path for subdirectory
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }

    /**
     * Get current uri
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getCurrent()
    {
        /** @noinspection PhpUndefinedConstantInspection */
        return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    /**
     * {@inheritdoc}
     */
    public static function create($data, $query = null)
    {
        $uri = '/' . rtrim(implode('/', $data), '/') . '.php';

        if(isset($query) && $query !== []) {
            /*
            $i = 0;
            foreach($query as $key => $para) {
                if($i == 0) {
                    $uri .= '?' . $key . '=' . $para;
                    $i++;
                    continue;
                }

                $uri .= '&' . $key . '=' . $para;
            }*/

            $uri .= '?' . http_build_query($query);
        }

        return $uri;
    }

    /**
     * {@inheritdoc}
     */
    public static function isValid($uri)
    {
        return true;
    }

    /**
     * Get root path
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getRootPath()
    {
        return $this->rootPath;
    }

    /**
     * Get scheme
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Get host
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Get port
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Get password
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Get path
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get query
     *
     * @param null|string $key Query key
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getQuery($key = null)
    {
        if(isset($key)) {
            if(isset($this->query[$key])) {
                return $this->query[$key];
            } else {
                return null;
            }
        }

        return $this->query;
    }

    /**
     * Get fragment
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getFragment()
    {
        return $this->fragment;
    }

    /**
     * Get base
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Set uri
     *
     * @param string $uri Uri
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function set($uri)
    {
        $this->uri = $uri;

        $url = parse_url($this->uri);

        $this->scheme = isset($url['scheme']) ? $url['scheme'] : null;
        $this->host   = isset($url['host']) ? $url['host'] : null;
        $this->port   = isset($url['port']) ? $url['port'] : null;
        $this->user   = isset($url['user']) ? $url['user'] : null;
        $this->pass   = isset($url['pass']) ? $url['pass'] : null;
        $this->path   = isset($url['path']) ? $url['path'] : null;
        $this->path   = rtrim($this->path, '.php');
        $this->path   = ltrim($this->path, $this->rootPath); // TODO: this could cause a bug if the rootpath is the same as a regular path which is usually the language
        $this->query  = isset($url['query']) ? $url['query'] : null;

        if(isset($this->query)) {
            parse_str($this->query, $this->query);
        }
        $this->fragment = isset($url['fragment']) ? $url['fragment'] : null;

        $this->base = $this->scheme . '://' . $this->host . $this->rootPath;
    }

    /**
     * {@inheritdoc}
     */
    public function parse($uri)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->uri;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($base)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthority()
    {
        return ($this->getUser() !== '' ? $this->getUser() . '@' : '') . $this->host . (isset($this->port) && $this->port !== '' ? ':' . $this->port : '');
    }

    /**
     * Get user
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserInfo()
    {
        return $this->user . (isset($this->pass) && $this->pass !== '' ? ':' . $this->pass : '');
    }
}
