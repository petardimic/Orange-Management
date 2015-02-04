<?php
namespace Modules\Tasks\Models;

/**
 * Task class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Task implements \Framework\Modles\MapperInterface
{
    /**
     * Database instance
     *
     * @var \Framework\DataStorage\Database\Database
     * @since 1.0.0
     */
    private $dbPool = null;

    /**
     * ID
     *
     * @var int
     * @since 1.0.0
     */
    public $id = null;

    /**
     * Title
     *
     * @var string
     * @since 1.0.0
     */
    public $title = null;

    /**
     * Creator
     *
     * @var int
     * @since 1.0.0
     */
    public $creator = null;

    /**
     * Created
     *
     * @var \DateTime
     * @since 1.0.0
     */
    public $created = null;

    /**
     * Description
     *
     * @var string
     * @since 1.0.0
     */
    public $description = null;

    /**
     * Status
     *
     * @var \Modules\Tasks\Models\TaskStatus
     * @since 1.0.0
     */
    public $status = null;

    /**
     * Due
     *
     * @var \DateTime
     * @since 1.0.0
     */
    public $due = null;

    /**
     * Done
     *
     * @var \DateTime
     * @since 1.0.0
     */
    public $done = null;

    /**
     * Task elements
     *
     * @var \Modules\Tasks\Models\TaskElement[]
     * @since 1.0.0
     */
    private $task_elements = [];

    /**
     * Constructor
     *
     * @param \Framework\DataStorage\Database\Pool $dbPool Database pool instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($dbPool)
    {
        $this->dbPool = $dbPool;
    }

    /**
     * Init task
     *
     * @param int $id Article ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function init($id)
    {
        $this->id = $id;
        $data     = null;
        $elements = null;

        switch($this->dbPool->get('core')->getType()) {
            case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                $sth = $this->dbPool->get('core')->con->prepare('SELECT
                            `' . $this->dbPool->get('core')->prefix . 'tasks`.*
                        FROM
                            `' . $this->dbPool->get('core')->prefix . 'tasks`
                       WHERE `' . $this->dbPool->get('core')->prefix . 'tasks`.`TaskID` = :id');

                $sth->bindValue(':id', $id, \PDO::PARAM_INT);
                $sth->execute();

                $data = $sth->fetchAll()[0];

                $sth = $this->dbPool->get('core')->con->prepare('SELECT
                            `' . $this->dbPool->get('core')->prefix . 'tasks_element`.*
                        FROM
                            `' . $this->dbPool->get('core')->prefix . 'tasks_element`
                       WHERE `' . $this->dbPool->get('core')->prefix . 'tasks_element`.`task` = :id');

                $sth->bindValue(':id', $id, \PDO::PARAM_INT);
                $sth->execute();

                $elements = $sth->fetchAll();
                break;
        }

        $this->title       = $data['title'];
        $this->creator     = $data['creator'];
        $this->created     = new \DateTime($data['created']);
        $this->description = $data['desc'];
        $this->status      = $data['status'];
        $this->due         = new \DateTime($data['due']);
        $this->done        = new \DateTime($data['done']);

        foreach($elements as $element) {
            $elementOBJ = new TaskElement($this->dbPool);
            $elementOBJ->setID($element['TaskelementID']);
            $elementOBJ->setTask($element['task']);
            $elementOBJ->setStatus($element['status']);
            $elementOBJ->setCreated(new \DateTime($element['created']));
            $elementOBJ->setCreator($element['creator']);
            $elementOBJ->setDescription($element['desc']);
            $elementOBJ->setDue(new \DateTime($element['due']));
            $elementOBJ->setForwarded($element['forwarded']);

            $this->addElement($elementOBJ);
        }
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDue()
    {
        return $this->due;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return TaskStatus
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStatus()
    {
        return $this->status;
    }

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
     * Adding new task element
     *
     * @param \Modules\Tasks\Models\TaskElement $element Task element
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addElement($element)
    {
        if(!array_key_exists($element->getId(), $this->task_elements)) {
            $this->task_elements[$element->getId()] = $element;
        }
    }

    /**
     * Remove Element from list
     *
     * @param int $id Task element ID
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function removeElement($id)
    {
        if(array_key_exists($id, $this->task_elements)) {
            unset($this->task_elements[$id]);
        }
    }

    /**
     * Get task elements
     *
     * @return TaskElement[]
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTaskElements()
    {
        return $this->task_elements;
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