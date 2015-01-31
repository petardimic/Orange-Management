<?php
namespace Modules\News\Models;

/**
 * News article class
 *
 * PHP Version 5.4
 *
 * @category   Module
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Article implements \Framework\Object\MapperInterface
{
    private static $validation = [
        'title' => [
            'isType' => [['string']],
            'hasLength' => [1, 100],
        ],
        'id' => [
            'isType' => [['integer']],
            'hasLimit' => [1, PHP_INT_MAX]
        ]
    ];

    /**
     * Database instance
     *
     * @var \Framework\DataStorage\Database\Database
     * @since 1.0.0
     */
    private $dbPool = null;

    /**
     * Article ID
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Title
     *
     * @var string
     * @since 1.0.0
     */
    private $title = '';

    /**
     * Content
     *
     * @var string
     * @since 1.0.0
     */
    private $content = '';

    /**
     * Plain
     *
     * @var string
     * @since 1.0.0
     */
    private $plain = '';

    /**
     * News type
     *
     * @var int
     * @since 1.0.0
     */
    private $type = null;

    /**
     * Language
     *
     * @var string
     * @since 1.0.0
     */
    private $lang = 'en';

    /**
     * Published
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $publish = null;

    /**
     * Created
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $created = null;

    /**
     * Author
     *
     * @var int
     * @since 1.0.0
     */
    private $author = 0;

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
     * Init article
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
            case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                $sth = $this->dbPool->get('core')->con->prepare('SELECT
                            `' . $this->dbPool->get('core')->prefix . 'news`.*
                        FROM
                            `' . $this->dbPool->get('core')->prefix . 'news`
                       WHERE `' . $this->dbPool->get('core')->prefix . 'news`.`NewsID` = :id');

                $sth->bindValue(':id', $id, \PDO::PARAM_INT);
                $sth->execute();

                $data = $sth->fetchAll()[0];
                break;
        }

        $this->title   = $data['title'];
        $this->author  = $data['author'];
        $this->content = $data['content'];
        $this->plain   = $data['plain'];
        $this->type    = $data['type'];
        $this->lang    = $data['lang'];
        $this->publish = new \DateTime($data['publish']);
        $this->created = new \DateTime($data['created']);
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
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getContent()
    {
        return $this->content;
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
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLanguage()
    {
        return $this->lang;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPlain()
    {
        return $this->plain;
    }

    /**
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPublish()
    {
        return $this->publish;
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
     * @return null
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getType()
    {
        return $this->type;
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
