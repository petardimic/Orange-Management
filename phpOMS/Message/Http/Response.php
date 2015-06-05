<?php
namespace phpOMS\Message\Http;

/**
 * Response class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Response
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Response extends \phpOMS\Message\ResponseAbstract implements \phpOMS\Message\Http\ResponseInterface, \phpOMS\Contract\RenderableInterface
{
// region Class Fields
    /**
     * Header
     *
     * @var string[][]
     * @since 1.0.0
     */
    private $header = [];

    /**
     * html head
     *
     * @var \phpOMS\Model\Html\Head
     * @since 1.0.0
     */
    private $head = null;

    /**
     * Response status
     *
     * @var int
     * @since 1.0.0
     */
    private $status = 200;

// endregion
    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        $this->head = new \phpOMS\Model\Html\Head();
    }

    /**
     * {@inheritdoc}
     */
    public function setHeader($key, $header, $overwrite = false)
    {
        if(!$overwrite && isset($this->header[$key])) {
            return false;
        } elseif($overwrite) {
            unset($this->header[$key]);
        }

        if(!isset($this->header[$key])) {
            $this->header[$key] = [];
        }

        $this->header[$key][] = $header;

        return true;
    }

    /**
     * Push header by ID
     *
     * @param mixed $name Header ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function pushHeaderId($name)
    {
        foreach($this->header[$name] as $key => $value) {
            header($name, $value);
        }
    }

    /**
     * Remove header by ID
     *
     * @param int $key Header key
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function removeHeader($key)
    {
        unset($this->header[$key]);
    }

    /**
     * Set response
     *
     * @param string $response Response to set
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * Push a specific response ID
     *
     * @param int $id Response ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function pushResponseId($id)
    {
        ob_start();
        echo $this->response[$id];
        ob_end_flush();
    }

    /**
     * Generate response
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getYield()
    {
        yield $this->head->render();

        foreach($this->response as $key => $response) {
            yield $response;
        }
    }

    /**
     * Generate response
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function render()
    {
        $render = $this->head->render();

        foreach($this->response as $key => $response) {
            $render .= $response;
        }

        return $render;
    }

    /**
     * Push all headers
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function pushHeader()
    {
        foreach($this->header as $name => $arr) {
            foreach($arr as $ele => $value) {
                header($name . ': ' . $value);
            }
        }
    }

    /**
     * Remove response by ID
     *
     * @param int $id Response ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function remove($id)
    {
        unset($this->response[$id]);
    }

    /**
     * {@inheritdoc}
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * {@inheritdoc}
     */
    public function getProtocolVersion()
    {
        return '1.0';
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders()
    {
        return $this->header;
    }

    /**
     * {@inheritdoc}
     */
    public function hasHeader($name)
    {
        return array_key_exists($name, $this->header);
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader($name)
    {
        return $this->header[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function getBody()
    {
        return $this->render();
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusCode()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function getReasonPhrase()
    {
        return $this->getHeader('Status');
    }
}
