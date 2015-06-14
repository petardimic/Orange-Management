<?php
namespace phpOMS\Message;

/**
 * Response abstract class
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
abstract class ResponseAbstract implements \phpOMS\Message\ResponseInterface
{

// region Class Fields
    /**
     * Language
     *
     * @var string
     * @since 1.0.0
     */
    protected $language = null;

    /**
     * Responses
     *
     * @var string[]
     * @since 1.0.0
     */
    protected $response = [];

    /**
     * Response status
     *
     * @var int
     * @since 1.0.0
     */
    protected $status = 200;

    /**
     * Account
     *
     * @var int
     * @since 1.0.0
     */
    protected $account = null;
// endregion

    /**
     * {@inheritdoc}
     */
    abstract public function setHeader($key, $header, $overwrite = true);

    /**
     * {@inheritdoc}
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * {@inheritdoc}
     */
    public function setLanguage($language)
    {
        return $this->language = $language;
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
     * Add response
     *
     * @param mixed   $key       Response id
     * @param mixed  $response  Response to add
     * @param boolean $overwrite Overwrite
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function set($key, $response, $overwrite = true)
    {
        if($overwrite || !isset($this->response[$key])) {
            $this->response[$key] = $response;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setStatusCode($status)
    {
        $this->status = $status;
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
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * {@inheritdoc}
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }
}
