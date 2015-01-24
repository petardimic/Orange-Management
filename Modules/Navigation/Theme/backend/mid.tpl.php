<?php
/**
 * @var \Modules\Navigation\Controller $this
 * @var array $data
 */

/* Looping through all links */
if(isset($this->nav[\Modules\Navigation\Models\NavigationType::CONTENT])) {
    echo '<ul id="m-nav" role="navigation">';

    foreach($this->nav[\Modules\Navigation\Models\NavigationType::CONTENT] as $key => $parent) {
        foreach($parent as $link) {
            if($link['nav_parent'] == $data[1]) {
                echo '<li><a href="' . \Framework\Uri\UriFactory::build([$this->app->request->getLanguage(),
                                                                         $link['nav_l0'],
                                                                         $link['nav_l1'],
                                                                         $link['nav_l2'],
                                                                         $link['nav_l3'],
                                                                         $link['nav_l4']]) . '">'
                     . $this->app->user->localization->lang[5][$link['nav_name']] . '</a>';
            }
        }
    }

    echo '</ul>';
}