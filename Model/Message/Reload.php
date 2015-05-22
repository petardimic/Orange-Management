<?php
namespace Model\Message;

class Reload implements \phpOMS\Contract\RenderableInterface, \phpOMS\Contract\ArrayableInterface
{

    const TYPE = 'reload';

    private $delay = 0;

    public function setDelay($delay)
    {
        $this->delay = $delay;
    }

    public function toArray()
    {
        return ['type' => self::TYPE, 'time' => $this->delay];
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }

    public function render()
    {
        return $this->__toString();
    }
}