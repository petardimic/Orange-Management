<?php
namespace Model\Message;

abstract class NotifyType extends \phpOMS\Datatypes\Enum
{

    const BINARY  = 0;

    const INFO    = 1;

    const WARNING = 2;

    const ERROR   = 3;

    const FATAL   = 4;

}
