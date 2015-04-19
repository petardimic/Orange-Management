<?php
namespace \phpOMS\Utils\PDF;

class PDF extends \vendor\tcpdf\TCPDF implements \phpOMS\Contract\RenderableInterface
{

// region Class Fields
    private $pageNumberStart = 0;

    private $pageNumberPages = [];

    private $pageNumberStyle = null;
// endregion

    public function __construct()
    {
    }

    public function setCreator()
    {
    }

    public function setAuthor()
    {
    }

    public function setOrientation()
    {
    }

    public function setPageFormat()
    {
    }

    public function setEncoding()
    {
    }

    public function setMargin()
    {
    }

    public function setHeaderMargin()
    {
    }

    public function setFooterMargin()
    {
    }

    public function setFont()
    {
    }

    public function Header()
    {
    }

    public function Footer()
    {
    }

    public function render()
    {
    }
}
