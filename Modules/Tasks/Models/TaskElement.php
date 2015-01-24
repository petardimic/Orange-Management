<?php
namespace Modules\Tasks\Models {
    /**
     * Task class
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    Framework
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class TaskElement implements \Framework\Object\MapperInterface
    {
        /**
         * Database instance
         *
         * @var \Framework\DataStorage\Database\Database
         * @since 1.0.0
         */
        private $db = null;

        /**
         * Id
         *
         * @var int
         * @since 1.0.0
         */
        private $id = null;

        /**
         * Description
         *
         * @var string
         * @since 1.0.0
         */
        private $description = '';

        /**
         * Task
         *
         * @var int
         * @since 1.0.0
         */
        private $task = 0;

        /**
         * Creator
         *
         * @var int
         * @since 1.0.0
         */
        private $creator = 0;

        /**
         * Created
         *
         * @var \DateTime
         * @since 1.0.0
         */
        private $created = null;

        /**
         * Status
         *
         * @var int
         * @since 1.0.0
         */
        private $status = null;

        /**
         * Due
         *
         * @var \DateTime
         * @since 1.0.0
         */
        private $due = null;

        /**
         * Forwarded to
         *
         * @var int
         * @since 1.0.0
         */
        private $forwarded = 0;

        /**
         * Constructor
         *
         * @param \Framework\DataStorage\Database\Database $db Database instance
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function __construct($db)
        {
            $this->db = $db;
        }

        /**
         * Init task element
         *
         * @param int $id Article ID
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function init($id)
        {
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
         * @param \DateTime $created
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setCreated($created)
        {
            $this->created = $created;
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
         * @param int $creator
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setCreator($creator)
        {
            $this->creator = $creator;
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
         * @param string $description
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setDescription($description)
        {
            $this->description = $description;
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
         * @param \DateTime $due
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setDue($due)
        {
            $this->due = $due;
        }

        /**
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getForwarded()
        {
            return $this->forwarded;
        }

        /**
         * @param int $forwarded
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setForwarded($forwarded)
        {
            $this->forwarded = $forwarded;
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
         * @param int $id
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * @param int $status
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setStatus($status)
        {
            $this->status = $status;
        }

        /**
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getTask()
        {
            return $this->task;
        }

        /**
         * @param int $task
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function setTask($task)
        {
            $this->task = $task;
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
}