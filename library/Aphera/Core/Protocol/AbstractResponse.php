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
namespace Aphera\Core\Protocol;

abstract class AbstractResponse extends AbstractMessage implements Response
{
    public function getAllow() {
        return $this->getHeader('Allow');
    }
    
    public function getType() {
        $status = $this->getStatus();
        if($status >= 200 && $status < 300) {
            return Response::TYPE_SUCCESS;
        } else if($status >= 300 && $status < 400) {
            return Response::TYPE_REDIRECT;
        } else if($status >= 400 && $status < 500) {
            return Response::TYPE_CLIENT_ERROR;
        } else if($status >= 500 && $status < 600) {
            return Response::TYPE_SERVER_ERROR;
        }
        return Response::TYPE_UNKNOWN;
    }
}