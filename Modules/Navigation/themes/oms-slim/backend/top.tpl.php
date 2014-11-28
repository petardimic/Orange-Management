<?php
/** @var \Modules\Navigation\Handler $this */

/* Looping through all links */
if (isset($this->nav[1])) {
    echo '<ul id="t-nav" role="navigation">';

    foreach ($this->nav[1] as $key => $parent) {
        foreach ($parent as $link) {
            echo '<li><a href="' . \Framework\Uri\UriFactory::build([$this->app->request->getLanguage(), $link['l0'], $link['l1'], $link['l2'], $link['l3'], $link['l4']]) . '">';

            if (isset($link['icon'])) {
                echo '<i class="' . $link['icon'] . '"></i>';
            }

            echo $this->app->user->localization->lang[5][$link['name']] . '</a>';
        }
    }

    echo '</ul>';
}