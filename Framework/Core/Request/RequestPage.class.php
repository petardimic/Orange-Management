<?php
namespace Framework\Core\Request {
    abstract class RequestPage extends \Framework\Base\Enum {
        const WEBSITE = 'website';
        const API = 'api';
        const SHOP = 'shop';
        const BACKEND = 'backend';
        const STATICP = 'static';
    }
}