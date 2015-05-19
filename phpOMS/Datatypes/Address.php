<?php
namespace phpOMS\Datatypes;

/**
 * Address class
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\Datatypes
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Address implements \phpOMS\Contract\JsonableInterface
{

// region Class Fields
    /**
     * Name of the receiver
     *
     * @var string
     * @since 1.0.0
     */
    private $recipient = null;

    /**
     * Sub of the address
     *
     * @var string
     * @since 1.0.0
     */
    private $fao = null;

    /**
     * Location
     *
     * @var \phpOMS\Datatypes\Location
     * @since 1.0.0
     */
    private $location = null;

// endregion

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        $this->$location = new \phpOMS\Datatypes\Location();
    }

    /**
     * Get recipient
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set recipient
     *
     * @param string $recipient Recipient
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return true;
    }

    /**
     * Get FAO
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getFAO()
    {
        return $this->fao;
    }

    /**
     * Set FAO
     *
     * @param string $fao FAO
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFAO($fao)
    {
        $this->fao = $fao;
    }

    /**
     * Get location
     *
     * @return \phpOMS\Datatypes\Location
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set location
     *
     * @param \phpOMS\Datatypes\Location $location Location
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function toJson($option = 0)
    {
    }
}
