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

use Aphera\Server\RequestContext;
use Aphera\Server\CollectionAdapter;
use Aphera\Server\CollectionInfo;
use Aphera\Server\ProviderHelper;
use Aphera\Server\ResponseContext;
use Aphera\Server\Context\BasicResponseContext;
use Aphera\Server\Context\ResponseContextException;

use Aphera\Model\Entry;
use Aphera\Model\ExtensibleElement;
use Aphera\Model\Feed;

use Aphera\Core\Protocol\ParseException;

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
        return array("application/atom+xml;type=entry");
    }
    
    /**
     * @param Entry $request 
     */
    protected function getEntryFromRequest(RequestContext $request) {
        $aphera = $request->getAphera();
        $parser = $aphera->getParser();

        $doc = null;
        try {
            $doc = $request->getDocument($parser);
        } catch(ParseException $e) {
            throw new ResponseContextException(400, $e);
        }
        
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

    /**
     * @param ResponseContextException $e
     * @return ResponseContext
     */
    public function createErrorResponse($e) {
        return $e->getResponseContext();
    }

    public function asCollectionElement(RequestContext $request, ExtensibleElement $parent) {
        $collection = $request->getAphera()->getFactory()->newCollection($parent);
        $collection->setHref($this->getHref($request));
        $collection->setTitle($this->getTitle($request));
        $collection->setAccept($this->getAccepts($request));
        return $collection;
    }

    /**
     * @param RequestContext $request
     * @return Feed
     */
    protected function createFeedBase(RequestContext $request) {
        $feed = $request->getAphera()->getFactory()->newFeed();
        $feed->setId($this->getId($request));
        return $feed;
    }

    protected function buildGetFeedResponse(Feed $feed) {
        $response = new BasicResponseContext($feed);
        $response->setStatus(200);
        return $response;
    }
}