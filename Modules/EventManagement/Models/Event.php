<?php
namespace Modules\EventManagement;

/**
 * Event class
 *
 * PHP Version 5.4
 *
 * @category   EventManager
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Event implements \Framework\Models\MapperInterface, \Framework\Pattern\Multition
{
    /**
     * ID
     *
     * @var int
     * @since 1.0.0
     */
    private $id = null;

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
    private $description = null;

    /**
     * Created
     *
     * @var datetime
     * @since 1.0.0
     */
    private $created = null;

    /**
     * Creator
     *
     * @var int
     * @since 1.0.0
     */
    private $creator = null;

    /**
     * Calendar
     *
     * @var \Modules\Calender\Models\Calender
     * @since 1.0.0
     */
    private $calendar = null;

    /**
     * People/Users
     *
     * @var array
     * @since 1.0.0
     */
    private $people = [];

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
        $this->descritpion = $desc;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getCreator()
    {
        return $this->creator;
    }

    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

    public function getCalendar()
    {
        return $this->calender;
    }

    public function setCalender($calender)
    {
        $this->calender = $calender;
    }

    public function getPeople()
    {
        return $this->people;
    }

    public function setPeople($people)
    {
        $this->people = $people;
    }

    public function addPerson($person)
    {
        if(!isset($this->people[$person['id']])) {
            $this->people[$person['id']] = $person;
        }
    }

    public function removePerson($id)
    {
        if(isset($this->people[$id])) {
            unset($this->people[$id]);
        }
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

    /**
     * Init object by ID
     *
     * This usually happens from DB or cache
     *
     * @param int $id Object ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function init($id)
    {
        // TODO: Implement init() method.
    }

    /**
     * Overwriting clone in order to maintain singleton pattern
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}