<?php

/**
 * Check if needle exists in multidimensional array
 *
 * @param mixed $needle   Needle for search
 * @param array $haystack Haystack for search
 * @param mixed $id       ID for search
 *
 * @return bool
 *
 * @since  1.0.0
 * @author Dennis Eichhorn <d.eichhorn@oms.com>
 */
function in_array_r($needle, $haystack, $id = null) {
    $found = false;

    if (isset($id) && isset($haystack[$id]) && $haystack[$id] === $needle) {
        return true;
    }

    foreach ($haystack as $item) {
        if ($item === $needle) {
            return true;
        } elseif (is_array($item)) {
            $found = in_array_r($needle, $item, $id);

            if ($found) {
                break;
            }
        }
    }

    return $found;
}