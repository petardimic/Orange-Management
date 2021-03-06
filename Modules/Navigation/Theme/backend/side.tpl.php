<?php
/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */
if(isset($this->nav[\Modules\Navigation\Models\NavigationType::SIDE])) {
    echo '<ul id="s-nav" role="navigation">';

    foreach($this->nav[\Modules\Navigation\Models\NavigationType::SIDE][\Modules\Navigation\Models\LinkType::CATEGORY] as $key => $parent) {
        echo '<li><ul><li>';

        if(isset($parent['nav_icon'])) {
            echo '<i class="' . $parent['nav_icon'] . '"></i>';
        }

        echo $this->l11n->lang[5][$parent['nav_name']] . '<i class="fa fa-chevron-down min"></i>
                    <i class="fa fa-chevron-up max vh"></i>';

        foreach($this->nav[\Modules\Navigation\Models\NavigationType::SIDE][\Modules\Navigation\Models\LinkType::LINK] as $key2 => $link) {
            if($link['nav_parent'] === $parent['nav_id']) {
                echo '<li>';
                echo '<a href="' . \phpOMS\Uri\UriFactory::build($link['nav_uri']) . '">' . $this->l11n->lang[5][$link['nav_name']] . '</a>';
            }
        }
        echo '</ul>';
    }

    echo '</ul>';
}