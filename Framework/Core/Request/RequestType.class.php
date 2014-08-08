<?php
namespace Framework\Core\Request {
    abstract class RequestType extends \Framework\Base\Enum {
        const GET = 'GET';
        const POST = 'POST';
        const PUT = 'PUT';
        const DELETE = 'DELETE';
    }
}