<?php
namespace Model\Message;

class Redirect implements \phpOMS\Contract\RenderableInterface, \phpOMS\Contract\ArrayableInterface
{

    const TYPE = 'redirect';

    private $uri   = '';

    private $delay = 0;

    public function setDelay($delay)
    {
        $this->delay = $delay;
    }

    public function toArray()
    {
        return ['type' => self::TYPE, 'time' => $this->delay, 'uri' => $this->uri];
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function render()
    {
        return json_encode($this->toArray());
    }
}