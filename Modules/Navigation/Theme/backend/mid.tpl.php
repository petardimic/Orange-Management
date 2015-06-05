<?php
/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */
if(isset($this->nav[\Modules\Navigation\Models\NavigationType::CONTENT])) {
    echo '<ul id="m-nav" role="navigation">';

    foreach($this->nav[\Modules\Navigation\Models\NavigationType::CONTENT] as $key => $parent) {
        foreach($parent as $link) {
            if($link['nav_parent'] == $this->parent) {
                echo '<li><a href="' . \phpOMS\Uri\UriFactory::build($link['nav_uri']) . '">'
                     . $this->l11n->lang[5][$link['nav_name']] . '</a>';
            }
        }
    }

    echo '</ul>';
}