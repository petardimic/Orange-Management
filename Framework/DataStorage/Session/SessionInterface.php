<?php

namespace Framework\DataStorage\Session;

interface SessionInterface
{
    public function get($key);

    public function set($key);

    public function delete($key);
}