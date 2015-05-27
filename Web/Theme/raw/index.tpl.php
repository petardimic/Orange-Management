<?php /** @noinspection PhpUndefinedMethodInspection */
if(isset(\phpOMS\Module\ModuleFactory::$loaded['Content'])) {
    \phpOMS\Module\ModuleFactory::$loaded['Content']->call($this->request, $this->response);
}