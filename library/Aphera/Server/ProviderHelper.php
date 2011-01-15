<?php
/**
 * Copyright 2011 Martin Vium
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
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