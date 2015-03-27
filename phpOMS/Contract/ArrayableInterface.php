<?php
namespace phpOMS\Contract;

interface ArrayableInterface {
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray();
}
