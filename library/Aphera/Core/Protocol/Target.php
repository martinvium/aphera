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

interface Target
{
    const TYPE_UNKOWN     = 1;
    const TYPE_NOT_FOUND  = 2;
    const TYPE_SERVICE    = 3;
    const TYPE_COLLECTION = 4;
    const TYPE_ENTRY      = 5;
    const TYPE_MEDIA      = 6;
    const TYPE_CATEGORIES = 7;

    public function getIdentity();
    
    public function getType();

    public function getParameter($name);

    public function getParameters();
}
