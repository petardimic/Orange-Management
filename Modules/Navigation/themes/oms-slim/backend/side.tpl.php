<?php
/** @var \Modules\Navigation\Handler $this */

/* Looping through all links */
if(isset($this->nav[\Modules\Navigation\NavigationType::SIDE])) {
    echo '<ul id="s-nav" role="navigation">';

    foreach($this->nav[\Modules\Navigation\NavigationType::SIDE][\Modules\Navigation\LinkType::CATEGORY] as $key => $parent) {
        echo '<li><ul><li>';

        if(isset($parent['icon'])) {
            echo '<i class="' . $parent['icon'] . '"></i>';
        }

        echo $this->app->user->localization->lang[5][$parent['name']] . '<i class="fa fa-chevron-down min"></i>
                    <i class="fa fa-chevron-up max vh"></i>';

        foreach($this->nav[\Modules\Navigation\NavigationType::SIDE][\Modules\Navigation\LinkType::LINK] as $key2 => $link) {
            if($link['parent'] === $parent['NavigationID']) {
                echo '<li>';
                echo '<a href="' . \Framework\Uri\UriFactory::build([$this->app->request->getLanguage(),
                                                                     $link['l0'],
                                                                     $link['l1'],
                                                                     $link['l2'],
                                                                     $link['l3'],
                                                                     $link['l4']]) . '">' . $this->app->user->localization->lang[5][$link['name']] . '</a>';
            }
        }
        echo '</ul>';
    }

    echo '</ul>';
}