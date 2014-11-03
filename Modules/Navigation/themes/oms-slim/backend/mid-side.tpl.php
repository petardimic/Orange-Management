<?php
/** @var \Modules\Navigation\Handler $this */

/* Looping through all links */
if (isset($this->nav[5])) {
    echo '<div class="b b-5 c3-2 c3" id="i3-2-5">'
        . '<h1>' . \Framework\Localization\Localization::$lang[0]['Navigation']
        . '<i class="fa fa-minus min"></i><i class="fa fa-plus max vh"></i>'
        . '</h1>'
        . '<div class="bc-1">'
        . '<ul id="ms-nav" role="navigation">';

    foreach ($this->nav[5] as $key => $parent) {
        foreach ($parent as $link) {
            if ($link['parent'] == $data[1]) {
                echo '<li><a href="' . $this->app->request->generate_uri([$this->app->request->request_lang, $link['l0'], $link['l1'], $link['l2'], $link['l3'], $link['l4']]) . '">'
                    . \Framework\Localization\Localization::$lang[5][$link['name']] . '</a>';
            }
        }
    }

    echo '</ul></div></div>';
}