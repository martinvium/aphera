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

use Aphera\Core\Protocol\Request;
use Aphera\Core\Parser;
use Aphera\Core\Protocol\Target;
use Aphera\Core\Aphera;

interface RequestContext extends Request
{
    /**
     * @return Aphera
     */
    public function getAphera();
    
    public function getMethod();
    
    public function getUri();
    
    public function getResolvedUri();
    
    public function getBaseUri();
    
    public function getDocument(Parser $parser);
    
    public function getInputStream();
    
    /**
     * @return Target
     */
    public function getTarget();

    public function getContextPath();

    public function getTargetPath();
}