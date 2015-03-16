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
class NewsArticle implements \phpOMS\Models\MapperInterface
{
    use \phpOMS\Validation\ModelValidationTrait;

    /**
     * Database instance
     *
     * @var \phpOMS\DataStorage\Database\Pool
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

    private static
        /** @noinspection PhpUnusedPrivateFieldInspection */
        $id_validate = [
        'isType'   => ['integer'],
        'hasLimit' => [0, PHP_INT_MAX]
    ];

    /**
     * Title
     *
     * @var string
     * @since 1.0.0
     */
    private $title = '';
    private static
        /** @noinspection PhpUnusedPrivateFieldInspection */
        $title_validate = [
        'isType'   => ['string'],
        'hasLength' => [1, 100]
    ];

    /**
     * Content
     *
     * @var string
     * @since 1.0.0
     */
    private $content = '';
    private static
        /** @noinspection PhpUnusedPrivateFieldInspection */
        $content_validate = [
        'isType'   => ['string']
    ];

    /**
     * Plain
     *
     * @var string
     * @since 1.0.0
     */
    private $plain = '';
    private static
        /** @noinspection PhpUnusedPrivateFieldInspection */
        $plain_validate = [
        'isType'   => ['string']
    ];

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
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database pool instance
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
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
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
     * @param string $title
     *
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTitle($title)
    {
        $this->setValidation($title, 'title');
    }

    /**
     * @param string $content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setContent($content)
    {
        $this->setValidation($content, 'content');
    }

    /**
     * @param string $plain
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPlain($plain)
    {
        $this->setValidation($plain, 'plain');
    }

    /**
     * @param int $type
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setType($type)
    {
        $this->setValidation($type, 'type');
    }

    /**
     * @param string $lang
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * @param \DateTime $publish
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
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
     * @param int $author
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setAuthor($author)
    {
        $this->author = $author;
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
