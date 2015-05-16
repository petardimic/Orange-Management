<?php
namespace Model\Message;

abstract class NotifyType extends \phpOMS\Datatypes\Enum
{

    const INFO    = 0;

    const WARNING = 1;

    const ERROR   = 1;

    const FATAL   = 1;

}
