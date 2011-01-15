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
namespace Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Model;

class Parser implements Core\Parser
{
    /**
     * @var Core\Factory
     */
    protected $factory;
    
    public function __construct(Core\Aphera $aphera) {
        $this->factory = $aphera->getFactory();
    }
    
    /**
     * @param resource $handle 
     * @return Model\Document
     */
    public function parseStream($handle) {
        $xml = \stream_get_contents($handle);
        $doc = $this->parseString($xml);
        return $doc;
    }
    
    /**
     * @param string $xml
     * @return Model\Document
     */
    public function parseString($xml) {
        $doc = $this->factory->newDocument();
        $doc->loadXML($xml);
        return $doc;
    }
}