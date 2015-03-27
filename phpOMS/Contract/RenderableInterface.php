<?php
namespace phpOMS\Contract;

interface RenderableInterface {
    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render();
}