<?php
/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */
if(isset($this->nav[\Modules\Navigation\Models\NavigationType::TOP])) {
    echo '<ul id="t-nav" role="navigation">';

    foreach($this->nav[\Modules\Navigation\Models\NavigationType::TOP] as $key => $parent) {
        foreach($parent as $link) {
            echo '<li><a href="' . \phpOMS\Uri\UriFactory::build([$this->language,
                                                                     $link['nav_l0'],
                                                                     $link['nav_l1'],
                                                                     $link['nav_l2'],
                                                                     $link['nav_l3'],
                                                                     $link['nav_l4']]) . '">';

            if(isset($link['nav_icon'])) {
                echo '<i class="' . $link['nav_icon'] . '"></i>';
            }

            echo $this->l11n->lang[5][$link['nav_name']] . '</a>';
        }
    }

    echo '</ul>';
}