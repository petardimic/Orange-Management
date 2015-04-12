<?php
/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */

/* Looping through all links */
if(isset($this->nav[\Modules\Navigation\Models\NavigationType::CONTENT_SIDE])) {
    echo '<div class="b b-5 c3-2 c3" id="i3-2-5">'
         . '<h1>' . $this->l11n->lang[0]['Navigation']
         . '<i class="fa fa-minus min"></i><i class="fa fa-plus max vh"></i>'
         . '</h1>'
         . '<div class="bc-1">'
         . '<ul id="ms-nav" role="navigation">';

    foreach($this->nav[\Modules\Navigation\Models\NavigationType::CONTENT_SIDE] as $key => $parent) {
        foreach($parent as $link) {
            /** @var array $data */
            if($link['nav_parent'] == $data[1]) {
                echo '<li><a href="' . \phpOMS\Uri\UriFactory::build([$this->language,
                                                                         $link['nav_l0'],
                                                                         $link['nav_l1'],
                                                                         $link['nav_l2'],
                                                                         $link['nav_l3'],
                                                                         $link['nav_l4']]) . '">'
                     . $this->l11n->lang[5][$link['nav_name']] . '</a>';
            }
        }
    }

    echo '</ul></div></div>';
}