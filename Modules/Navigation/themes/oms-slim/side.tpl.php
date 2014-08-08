<?php
/** @var \Modules\Navigation\Navigation $this */

/* Looping through all links */
if (isset($this->nav[2])) {
    echo '<ul id="s-nav">';

    foreach ($this->nav[2][0] as $key => $parent) {
        echo '<ul>';
        echo '<li>';

        if (isset($parent['icon'])) {
            echo '<i class="' . $parent['icon'] . '"></i>';
        }

        echo \Framework\Localization\Localization::$lang[5][$parent['name']] . '<i class="fa fa-chevron-down min"></i>
                    <i class="fa fa-chevron-up max vh"></i>';
        echo '</li>';

        foreach ($this->nav[2][1] as $key2 => $link) {
            if ($link['parent'] === $parent['id']) {
                echo '<li>';
                echo '<a href="' . $this->request->generate_uri([$this->request->request_lang, $link['l0'], $link['l1'], $link['l2'], $link['l3'], $link['l4']]) . '">' . \Framework\Localization\Localization::$lang[5][$link['name']] . '</a>';
                echo '</li>';
            }
        }
        echo '</ul>';
    }

    echo '</ul>';
}