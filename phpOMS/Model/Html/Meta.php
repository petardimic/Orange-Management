<?php
namespace phpOMS\Model\Html;

/**
 * Meta class
 *
 * PHP Version 5.4
 *
 * @category   Log
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Meta implements \phpOMS\Contract\RenderableInterface
{

// region Class Fields
    /**
     * Keywords
     *
     * @var string[]
     * @since 1.0.0
     */
    private $keywords = [];

    /**
     * Author
     *
     * @var string
     * @since 1.0.0
     */
    private $author = null;

    /**
     * Charset
     *
     * @var string
     * @since 1.0.0
     */
    private $charset = null;

    /**
     * Description
     *
     * @var string
     * @since 1.0.0
     */
    private $description = null;

    /**
     * Language
     *
     * @var string
     * @since 1.0.0
     */
    private $language = 'en';

// endregion

    /**
     * Add keyword
     *
     * @param string $keyword Keyword
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addKeyword($keyword)
    {
        if(!in_array($keyword, $this->keywords)) {
            $this->keywords[] = $keyword;
        }
    }

    /**
     * Set language
     *
     * @param string $language Language
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Get keywords
     *
     * @return string[] Keywords
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Get author
     *
     * @return string Author
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public
    function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param string $author Author
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get charset
     *
     * @return string Charset
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Set charset
     *
     * @param string $charset Charset
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    /**
     * Get description
     *
     * @return string Descritpion
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string Descritpion
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get language
     *
     * @return string Language
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return (count($this->keywords) > 0 ? '<meta name="keywords" content="' . implode(',', $this->keywords) . '">"' : '')
               . (isset($this->author) ? '<meta name="author" content="' . $this->author . '">' : '')
               . (isset($this->description) ? '<meta name="description" content="' . $this->description . '">' : '')
               . (isset($this->charset) ? '<meta charset="' . $this->charset . '">' : '')
               . '<meta name="generator" content="Orange Management">';
    }
}
