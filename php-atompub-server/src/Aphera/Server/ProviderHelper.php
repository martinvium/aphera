<?php
namespace Aphera\Server;

use Aphera\Server\Context;

class ProviderHelper
{
    public static function notAllowed(RequestContext $request, $message)
    {
        return self::createErrorResponse(405, $message);
    }
    
    public static function notAllowedMethod(RequestContext $request)
    {
        return self::notAllowed($request, "Method Not Allowed");
    }
    
    public static function createErrorResponse($code, $message)
    {
        $rc = new Context\SimpleResponseContext();
        $rc->setStatus($code);
        $rc->setMessage($message);
        return $rc;
    }
}