<?php
namespace Modules\Surveys;

/**
 * Question class
 *
 * PHP Version 5.4
 *
 * @category   Surveys
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Question implements \Framework\Modles\MapperInterface, \Framework\Pattern\Multition
{
    /**
     * ID
     *
     * @var int
     * @since 1.0.0
     */
    private $id = '';

    /**
     * Name
     *
     * @var string
     * @since 1.0.0
     */
    private $name = '';

    /**
     * Description
     *
     * @var string
     * @since 1.0.0
     */
    private $description = '';

    private static $instances = [];

    public function __construct($id)
    {
    }

    public function getInstance($id)
    {
        if(!isset(self::$instances[$id])) {
            self::$instances[$id] = new self($id);
        }

        return self::$instances[$id];
    }

    /**
     * {@inheritdoc}
     */
    public function init($id)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function __clone()
    {
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($desc)
    {
        $this->description = $desc;
    }

    /**
     * {@inheritdoc}
     */
    public function delete()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function update()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($data)
    {
    }
}