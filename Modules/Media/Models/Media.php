<?php
namespace Modules\Media\Models;

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
class Media
{

// region Class Fields
    /**
     * Database instance
     *
     * @var \phpOMS\DataStorage\Database\Connection\ConnectionAbstract
     * @since 1.0.0
     */
    private $connection = null;

    /**
     * ID
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Name
     *
     * @var string
     * @since 1.0.0
     */
    private $name = '';

    /**
     * Extension
     *
     * @var string
     * @since 1.0.0
     */
    private $extension = '';

    /**
     * File size in bytes
     *
     * @var int
     * @since 1.0.0
     */
    private $size = 0;

    /**
     * Author
     *
     * @var int
     * @since 1.0.0
     */
    private $created_by = 0;

    /**
     * Uploaded
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $created_at = null;

    /**
     * Resource path
     *
     * @var string
     * @since 1.0.0
     */
    private $path = null;

    /**
     * Permissions
     *
     * @var array
     * @since 1.0.0
     */
    private $permissions = [
        'visibile'   => ['groups' => [],
                         'users'  => []],
        'editable'   => ['groups' => [],
                         'users'  => []],
        'permission' => ['groups' => [],
                         'users'  => []],
        'deletable'  => ['groups' => [],
                         'users'  => []]
    ];

// endregion

    /**
     * Constructor
     *
     * @param \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $connection Database pool instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
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

        switch($this->dbPool->get('core')->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $sth = $this->dbPool->get('core')->con->prepare('SELECT
                            `' . $this->dbPool->get('core')->prefix . 'media`.*
                        FROM
                            `' . $this->dbPool->get('core')->prefix . 'media`
                       WHERE `' . $this->dbPool->get('core')->prefix . 'media`.`media_id` = :id');

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
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * {@inheritdoc}
     */
    public function insert()
    {
        $sth = $this->connection->con->prepare('INSERT INTO ' . $this->connection->prefix . 'media
        (media_name, media_file, media_extension, media_size, media_created_by, media_created_at)
        VALUES (:media_name, :media_file, :media_extension, :media_size, :media_created_by, :media_created_at)');

        $sth->bindParam(':media_id', $this->id, \PDO::PARAM_INT);
        $sth->bindParam(':media_name', $this->name, \PDO::PARAM_INT);
        $sth->bindParam(':media_file', $this->path, \PDO::PARAM_INT);
        $sth->bindParam(':media_extension', $this->extension, \PDO::PARAM_INT);
        $sth->bindParam(':media_size', $this->size, \PDO::PARAM_INT);
        $sth->bindParam(':media_created_by', $this->created_by, \PDO::PARAM_INT);
        $sth->bindParam(':media_media_created_at', $this->created_at, \PDO::PARAM_INT);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($data)
    {
    }
}