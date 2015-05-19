<?php
namespace Model\Message;

class Notify
{

    const TYPE = 'redirect';

    private $title   = '';

    private $message = '';

    private $delay   = 0;

    private $level   = 0;

    public function setDelay($delay)
    {
        $this->delay = $delay;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function render()
    {
        return json_encode(['type'  => self::TYPE,
                            'time'  => $this->delay,
                            'msg'   => $this->message,
                            'title' => $this->title,
                            'level' => $this->level]);
    }
}