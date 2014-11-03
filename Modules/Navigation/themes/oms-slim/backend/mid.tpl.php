<?php
/** @var \Modules\Navigation\Handler $this */

/* Looping through all links */
if (isset($this->nav[3])) {
    echo '<ul id="m-nav" role="navigation">';

    foreach ($this->nav[3] as $key => $parent) {
        foreach ($parent as $link) {
            if ($link['parent'] == $data[1]) {
                echo '<li><a href="' . $this->app->request->generate_uri([$this->app->request->request_lang, $link['l0'], $link['l1'], $link['l2'], $link['l3'], $link['l4']]) . '">'
                    . \Framework\Localization\Localization::$lang[5][$link['name']] . '</a>';
            }
        }
    }

    echo '</ul>';
}