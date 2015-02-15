<?php
namespace phpOMS\Message\Http;

/**
 * Response class
 *
 * PHP Version 5.4
 *
 * @todo       : maybe add header true/false member variable for overwrite if exists
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
class Response
{
    /**
     * Header
     *
     * @var array
     * @since 1.0.0
     */
    private $header = null;

    /**
     * Responses
     *
     * @var string[]
     * @since 1.0.0
     */
    private $response = [];

    /**
     * Auto push on add?
     *
     * @var bool
     * @since 1.0.0
     */
    private $autoPush = false;

    /**
     * {@inheritdoc}
     */
    public function addHeader($key, $header, $overwrite = true)
    {
        if(!$overwrite && isset($this->header[$key])) {
            return false;
        }

        $this->header[$key] = $header;

        if($this->autoPush) {
            $this->pushHeaderId($key);
        }

        return true;
    }

    /**
     * Push all headers
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function pushHeader()
    {
        foreach($this->header as $ele) {
            header($ele, true);
        }
    }

    /**
     * Push header by ID
     *
     * @param mixed $key Header ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function pushHeaderId($key)
    {
        header($key, true);
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
     * Add response
     *
     * @param mixed  $key      Response id
     * @param string $response Response to add
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function add($key, $response)
    {
        $this->response[$key] = $response;

        if($this->autoPush) {
            $this->pushResponseId(count($this->response));
        }
    }

    /**
     * Get response by ID
     *
     * @param int $id Response ID
     *
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function &get($id)
    {
        return $this->response[$id];
    }

    /**
     * Generate response
     *
     * @param int $id Response ID
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function make($id)
    {
        $this->pushHeader();

        return $this->get($id);
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
     * Push all responses
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function push()
    {
        ob_start();

        foreach($this->response as $key => $response) {
            echo $this->response[$key];
        }

        ob_end_flush();
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
     * Auto push added responses
     *
     * @param bool $push
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setAutoPush($push)
    {
        $this->autoPush = (bool) $push;
    }

    /**
     * Is auto push enabled?
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getAutoPush()
    {
        return $this->autoPush;
    }
}