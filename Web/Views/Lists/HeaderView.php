<?php
namespace Web\Views\Lists;

/**
 * Header view
 *
 * PHP Version 5.4
 *
 * @category   Theme
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class HeaderView extends \phpOMS\Views\View
{
    /**
     * Header elements
     *
     * @var array
     * @since 1.0.0
     */
    protected $header = [];

    /**
     * Table title
     *
     * @var string
     * @since 1.0.0
     */
    protected $title = '';

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getHeaders()
    {
        return $this->header;
    }

    /**
     * @param array $header
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * Add element to header
     *
     * @param array $header
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addHeader($header)
    {
        $this->header += $header;
    }

    /**
     * Remove element by id
     *
     * @param mixed $id Elment id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function removeHeader($id)
    {
        if(isset($this->header[$id])) {
            unset($this->header[$id]);
        }
    }
}
