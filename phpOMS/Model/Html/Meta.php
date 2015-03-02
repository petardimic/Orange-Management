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
class Meta
{
    private $keywords = [];
    private $author = null;
    private $charset = null;
    private $description = null;

    public function addKeyword($keyword)
    {
    }

    public function setAuthor($author)
    {
    }

    public function setCharset($charset)
    {
    }

    public function setDescription($description)
    {
    }

    public function setLanguage($lang)
    {
    }

    public function setExpire($expire)
    {
    }

    public function getKeywords()
    {
    }

    public function getAuthor()
    {
    }

    public function getCharset()
    {
    }

    public function getDescription()
    {
    }

    public function getLanguage()
    {
    }

    public function getExpire()
    {
    }

    public function __toString()
    {
        return (count($this->keywords) > 0 ? '<meta name="keywords" content="' . implode(',', $this->keywords) . '">"' : '')
               . (isset($this->author) ? '<meta name="author" content="' . $this->author . '">' : '')
               . (isset($this->description) ? '<meta name="description" content="' . $this->description . '">' : '')
               . (isset($this->charset) ? '<meta charset="' . $this->charset . '">' : '')
               . '<meta name="generator" content="Orange Management">';
    }
}