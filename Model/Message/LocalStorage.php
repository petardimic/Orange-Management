<?php
namespace Model\Message;

class LocalStorage implements \phpOMS\Contract\RenderableInterface, \phpOMS\Contract\ArrayableInterface
{

    const TYPE = 'localstorage';

    private $values = [];

    public function setValue($key, $value, $overwrite = true) {
        if($overwrite || !isseT($this->values[$key])) {
            $this->values[$key] = $value;
        }
    }

    public function toArray()
    {
        return ['type' => self::TYPE, 'values' => $this->values];
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