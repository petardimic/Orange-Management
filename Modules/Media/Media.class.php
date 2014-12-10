<?php
namespace Modules\Media {
    /**
     * Media class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Modules\Media
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Media implements \Framework\Object\ObjectInterface {
        private $db = null;
        private $id = 0;
        private $name = '';
        private $extension = null;
        private $size = 0;
        private $author = 0;
        private $created = null;
        private $permissions = ['visibile' => ['groups' => [],
                                               'users'  => []],
                                'editable' => ['groups' => [],
                                               'users'  => []]];

        public function __construct($db) {
            $this->db = $db;
        }

        public function getID() {
            return $this->id;
        }

        public function init($id) {
            $this->id = $id;

            switch($this->db->getType()) {
                case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                    $sth = $this->db->con->prepare('SELECT
                            `' . $this->db->prefix . 'media`.*
                        FROM
                            `' . $this->db->prefix . 'media`
                       WHERE `' . $this->db->prefix . 'media`.`MediaID` = :id');

                    $sth->bindValue(':id', $id, \PDO::PARAM_INT);
                    $sth->execute();

                    $data = $sth->fetchAll()[0];
                    break;
            }

            $this->name      = $data['name'];
            $this->extension = $data['type'];
            $this->author    = $data['creator'];
            $this->created   = new \DateTime($data['created']);
            $this->size      = $data['size'];
        }

        /**
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getAuthor() {
            return $this->author;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getCreated() {
            return $this->created;
        }

        /**
         * @return null
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getExtension() {
            return $this->extension;
        }

        /**
         * @return string
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getName() {
            return $this->name;
        }

        /**
         * @return int
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public function getSize() {
            return $this->size;
        }

        /**
         * {@inheritdoc}
         */
        public function delete() {
        }

        /**
         * {@inheritdoc}
         */
        public function create() {
        }

        /**
         * {@inheritdoc}
         */
        public function update() {
        }

        /**
         * {@inheritdoc}
         */
        public function serialize() {
        }

        /**
         * {@inheritdoc}
         */
        public function unserialize($data) {
        }
    }
}