<?php
/**
 * @var \Framework\Views\ViewAbstract $this
 */
/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->l11n);
$nav->setTemplate('/Modules/Navigation/Theme/backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1002701001);

/*
 * Template
 */
echo $nav->getResponse();