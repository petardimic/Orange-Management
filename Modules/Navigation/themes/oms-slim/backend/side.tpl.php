<?php
/** @var \Modules\Navigation\Navigation $this */

/* Looping through all links */
if (isset($this->nav[2])) {
    echo '<ul id="s-nav" role="navigation">';

    foreach ($this->nav[2][0] as $key => $parent) {
        echo '<li><ul><li>';

        if (isset($parent['icon'])) {
            echo '<i class="' . $parent['icon'] . '"></i>';
        }

        echo \Framework\Localization\Localization::$lang[5][$parent['name']] . '<i class="fa fa-chevron-down min"></i>
                    <i class="fa fa-chevron-up max vh"></i>';

        foreach ($this->nav[2][1] as $key2 => $link) {
            if ($link['parent'] === $parent['id']) {
                echo '<li>';
                echo '<a href="' . $this->app->request->generate_uri([$this->app->request->request_lang, $link['l0'], $link['l1'], $link['l2'], $link['l3'], $link['l4']]) . '">' . \Framework\Localization\Localization::$lang[5][$link['name']] . '</a>';
            }
        }
        echo '</ul>';
    }

    echo '</ul>';
}