<?php
namespace Model\Message;

class Reload implements \phpOMS\Contract\RenderableInterface
{
    private $delay = 0;

    public function setDelay($delay) {
        $this->delay = $delay;
    }

    public function render()
    {
        return json_encode(['type' => 'reload', 'time' => $this->delay]);
    }
}