<?php
namespace Aphera\Server;

use Aphera\Server\Context\EmptyResponseContext;

class ProviderHelper
{
    public static function notAllowed(RequestContext $request, $message) {
        return self::createErrorResponse(405, $message);
    }
    
    public static function notAllowedMethod(RequestContext $request) {
        return self::notAllowed($request, "Method Not Allowed");
    }
    
    public static function notFound(RequestContext $request) {
        return self::createErrorResponse(404, "Not Found");
    }
    
    public static function createErrorResponse($code, $message) {
        $rc = new EmptyResponseContext();
        $rc->setStatus($code);
        $rc->setStatusText($message);
        return $rc;
    }
}