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
namespace Aphera\Server\Adapter;

use Aphera\Model\Entry;
use Aphera\Server\RequestContext;
use Aphera\Server\CollectionAdapter;
use Aphera\Server\CollectionInfo;
use Aphera\Server\ProviderHelper;
use Aphera\Server\Context\BasicResponseContext;
use Aphera\Server\ResponseContext;

abstract class AbstractCollectionAdapter implements CollectionAdapter, CollectionInfo
{
    private $href = '';
    
    abstract public function getId(RequestContext $request);
    
    abstract public function getAuthor(RequestContext $request);
    
    public function getHref(RequestContext $request) {
        return $this->href;
    }

    /**
     * @todo add location + other data
     * @param Entry $entry
     * @return ResponseContext
     */
    protected function buildCreateEntryResponse(Entry $entry) {
        $response = new BasicResponseContext($entry);
        $response->setStatus(201);
        $response->setStatusText('Created');
        return $response;
        
    }
    
    public function setHref($href) {
        $this->href = (string)$href;
    }
    
    public function postEntry(RequestContext $request) {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function getEntry(RequestContext $request) {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function putEntry(RequestContext $request) {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function deleteEntry(RequestContext $request) {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function optionsEntry(RequestContext $request) {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function headEntry(RequestContext $request) {
        return ProviderHelper::notAllowedMethod($request);
    }
    
    public function getAccepts(RequestContext $request) {
        return "application/atom+xml;type=entry";
    }
    
    /**
     * @param Entry $request 
     */
    protected function getEntryFromRequest(RequestContext $request) {
        $aphera = $request->getAphera();
        $parser = $aphera->getParser();
        $doc = $request->getDocument($parser);
        return $doc->getRootEntry();
    }
    
    /**
     * Get's the name of the specific resource requested
     * 
     * @param RequestContext $request 
     */
    protected function getResourceName(RequestContext $request) {
        // picks out the last part of the target path??
        // https://github.com/apache/abdera/blob/trunk/server/src/main/java/org/apache/abdera/protocol/server/impl/AbstractCollectionAdapter.java
    }
}