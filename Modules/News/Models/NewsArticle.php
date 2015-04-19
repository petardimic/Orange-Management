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
class NewsArticle extends \phpOMS\Model\ORM
{
    /**
     * Database instance
     *
     * @var \phpOMS\DataStorage\Database\Connection\Connection
     * @since 1.0.0
     */
    private $connection = null;

    /**
     * Article ID
     *
     * @var int
     * @since 1.0.0
     */
    private $id          = null;
    private static
        /** @noinspection PhpUnusedPrivateFieldInspection */
            $id_validate = [
                'isType'   => ['integer'],
                'hasLimit' => [0, PHP_INT_MAX]
            ];

    /**
     * Primary table
     *
     * @var string
     * @since 1.0.0
     */
    protected $table = 'news';

    /**
     * Title
     *
     * @var string
     * @since 1.0.0
     */
    private $title          = '';
    private static
        /** @noinspection PhpUnusedPrivateFieldInspection */
            $title_validate = [
                'isType'    => ['string'],
                'hasLength' => [1, 100]
            ];

    /**
     * Content
     *
     * @var string
     * @since 1.0.0
     */
    private $content          = '';
    private static
        /** @noinspection PhpUnusedPrivateFieldInspection */
            $content_validate = [
                'isType' => ['string']
            ];

    /**
     * Plain
     *
     * @var string
     * @since 1.0.0
     */
    private $plain          = '';
    private static
        /** @noinspection PhpUnusedPrivateFieldInspection */
            $plain_validate = [
                'isType' => ['string']
            ];

    /**
     * News type
     *
     * @var int
     * @since 1.0.0
     */
    private $type          = \Modules\News\Models\NewsType::ARTICLE;
    private static
        /** @noinspection PhpUnusedPrivateFieldInspection */
            $type_validate = [
                'isType' => ['\Modules\News\Models\NewsType']
            ];

    /**
     * Language
     *
     * @var string
     * @since 1.0.0
     */
    private $lang          = \phpOMS\Localization\ISO639Enum::EN;
    private static
        /** @noinspection PhpUnusedPrivateFieldInspection */
            $lang_validate = [
                'isType' => ['\phpOMS\Localization\ISO639']
            ];

    /**
     * Constructor
     *
     * @param \phpOMS\DataStorage\Database\Connection\Connection $connection Database connection
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Init article
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function init($level = \phpOMS\Model\InitializationLevel::MINIMUM)
    {
        $query = $this->query();

        switch($level) {
            case \phpOMS\Model\InitializationLevel::MAXIMUM:
                $query->table($this->table)
                    ->select(['plain']);
            case \phpOMS\Model\InitializationLevel::MEDIUM:
                $query->table($this->table)
                    ->select(['content']);
            case \phpOMS\Model\InitializationLevel::MINIMUM:
                $query->table($this->table)
                    ->select(['title', 'author', 'published_at', 'created_by'])
                    ->select(['name1', 'name2', 'name3'], 'account')
                    ->join([$this->table, 'account', 'author', '=', 'id'])
                    ->where('id', '=', $this->id);
                break;
        }

        $resultSet = $this->dbPool->get('core')->execute($query->__toString());

        $this->fill($resultSet[$this->table]);

        $this->author = new Account();
        $this->author->fill($resultSet['account']);
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
