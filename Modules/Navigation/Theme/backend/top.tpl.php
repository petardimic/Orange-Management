<?php
/** @var \Modules\Navigation\Controller $this */

/* Looping through all links */
if(isset($this->nav[\Modules\Navigation\Models\NavigationType::TOP])) {
    echo '<ul id="t-nav" role="navigation">';

    foreach($this->nav[\Modules\Navigation\Models\NavigationType::TOP] as $key => $parent) {
        foreach($parent as $link) {
            echo '<li><a href="' . \Framework\Uri\UriFactory::build([$this->app->request->getLanguage(),
                                                                     $link['nav_l0'],
                                                                     $link['nav_l1'],
                                                                     $link['nav_l2'],
                                                                     $link['nav_l3'],
                                                                     $link['nav_l4']]) . '">';

            if(isset($link['nav_icon'])) {
                echo '<i class="' . $link['nav_icon'] . '"></i>';
            }

            echo $this->app->user->localization->lang[5][$link['nav_name']] . '</a>';
        }
    }

    echo '</ul>';
}