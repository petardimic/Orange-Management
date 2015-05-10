<?php
namespace phpOMS\Message\Http;

/**
 * Request class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Request
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Request extends \phpOMS\Message\RequestAbstract
{

// region Class Fields
    /**
     * Browser type
     *
     * @var \phpOMS\Message\Http\BrowserType
     * @since 1.0.0
     */
    public $browser = null;

    /**
     * OS type
     *
     * @var \phpOMS\Message\Http\OSType
     * @since 1.0.0
     */
    public $os = null;

    /**
     * Request information
     *
     * @var string[]
     * @since 1.0.0
     */
    private $info = null;

    /**
     * Request hash
     *
     * @var array
     * @since 1.0.0
     */
    private $hash = null;

    /**
     * Web request type
     *
     * @var \phpOMS\Message\RequestDestination
     * @since 1.0.0
     */
    private $requestDestination = null;


// endregion

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        parent::__construct();
        $this->uri = new \phpOMS\Uri\Http();
    }

    public function init($uri = null)
    {
        $this->scheme = 'http';
        $this->host = $_SERVER['HTTP_HOST'];

        $this->data = [
            'l0' => '',
            'l1' => '',
            'l2' => '',
            'l3' => '',
            'l4' => '',
            'l5' => '',
            'l6' => '',
            'l7' => '',
        ];

        if($uri === null) {
            /** @noinspection PhpWrongStringConcatenationInspection */
            $this->data = (isset($_GET) ? $_GET : file_get_contents('php://input')) + $this->data;
        } else {
            $this->setMethod($uri['type']); // TODO: is this correct?
            $this->data = $this->uri->routify($uri['request']) + $this->data;
        }

        $this->requestDestination = $this->data['l1'];
        $this->lang               = $this->data['l0'];

        $this->hash = null;
        $this->hash = [
            $this->hashRequest([$this->data['l1']]),
            $this->hashRequest([$this->data['l1'], $this->data['l2']]),
            $this->hashRequest([$this->data['l1'], $this->data['l2'], $this->data['l3']]),
            $this->hashRequest([$this->data['l1'],
                                $this->data['l2'],
                                $this->data['l3'],
                                $this->data['l4']]),
            $this->hashRequest([$this->data['l1'],
                                $this->data['l2'],
                                $this->data['l3'],
                                $this->data['l4'],
                                $this->data['l5']]),
        ];
    }

    /**
     * Set request type
     *
     * @param \phpOMS\Message\RequestMethod $type Request type
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setMethod($type)
    {
        $this->type = $type;
    }

    /**
     * Generate request hash
     *
     * @param array $request Request array
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function hashRequest($request)
    {
        return sha1(implode('', $request));
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestInfo()
    {
        if($this->info === null) {
            $this->info['browser'] = $this->getBrowser();
            $this->info['os']      = $this->getOS();
        }

        return $this->info;
    }

    /**
     * Determine request browser
     *
     * @return \phpOMS\Message\Http\BrowserType
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getBrowser()
    {
        if($this->browser == null) {
            $arr = BrowserType::getConstants();

            $http_request_type = strtolower($_SERVER['HTTP_USER_AGENT']);

            foreach($arr as $key => $val) {
                if(stripos($http_request_type, $val)) {
                    $this->browser = $val;
                    break;
                }
            }
        }

        return $this->browser;
    }

    /**
     * Determine request OS
     *
     * @return \phpOMS\Message\Http\OSType
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getOS()
    {
        if($this->os == null) {
            $arr = OSType::getConstants();

            $http_request_type = strtolower($_SERVER['HTTP_USER_AGENT']);

            foreach($arr as $key => $val) {
                if(stripos($http_request_type, $val)) {
                    $this->os = $val;
                    break;
                }
            }
        }

        return $this->os;
    }

    /**
     * Get request hashes
     *
     * @return array Request hashes
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrigin()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Is request made via https
     *
     * @param int $port Secure port
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function isHttps($port = 443)
    {
        return
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
            || (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')
            || $_SERVER['SERVER_PORT'] == $port;
    }

    /**
     * Stringify request
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __toString()
    {
        $lastElement = end($this->hash);;
        reset($this->hash);

        return $lastElement;
    }

    /**
     * Get request type
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getMethod()
    {
        if(!isset($this->type)) {
            $this->type = $_SERVER['REQUEST_METHOD'];
        }

        return $this->type;
    }

    /**
     * @return \phpOMS\Message\RequestDestination
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getRequestDestination()
    {
        return $this->requestDestination;
    }

    /**
     * @param \phpOMS\Message\RequestDestination $requestDestination
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setRequestDestination($requestDestination)
    {
        $this->requestDestination = $requestDestination;
    }
}
