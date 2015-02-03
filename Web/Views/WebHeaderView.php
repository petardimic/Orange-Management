<?php
namespace Web\Views;

class WebHeaderView extends \Framework\Views\ViewAbstract {
  protected $charset = 'utf-8';
  
  protected $title = '';
  
  protected $keywords = [];
  
  protected $author = null;
  
  protected $language = null;
}
