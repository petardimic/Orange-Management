<?php
/** @var \Modules\Navigation\Handler $this */

/* Looping through all links */
if (isset($this->nav[\Modules\Navigation\NavigationType::CONTENT])) {
    echo '<ul id="m-nav" role="navigation">';

    foreach ($this->nav[\Modules\Navigation\NavigationType::CONTENT] as $key => $parent) {
        foreach ($parent as $link) {
            if ($link['parent'] == $data[1]) {
                echo '<li><a href="' . \Framework\Uri\UriFactory::build([$this->app->request->getLanguage(), $link['l0'], $link['l1'], $link['l2'], $link['l3'], $link['l4']]) . '">'
                    . $this->app->user->localization->lang[5][$link['name']] . '</a>';
            }
        }
    }

    echo '</ul>';
}