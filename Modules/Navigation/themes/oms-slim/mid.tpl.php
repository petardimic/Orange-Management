<?php
/** @var \Modules\Navigation\Navigation $this */

/* Looping through all links */
if (isset($this->nav[3])) {
    echo '<ul id="m-nav">';

    foreach ($this->nav[3] as $key => $parent) {
        foreach ($parent as $link) {
            if ($link['parent'] == $data[1]) {
                echo '<li><a href="' . $this->request->generate_uri([$this->request->request_lang, $link['l0'], $link['l1'], $link['l2'], $link['l3'], $link['l4']]) . '">'
                    . \Framework\Localization\Localization::$lang[5][$link['name']] . '</a></li>';
            }
        }
    }

    echo '</ul>';
}