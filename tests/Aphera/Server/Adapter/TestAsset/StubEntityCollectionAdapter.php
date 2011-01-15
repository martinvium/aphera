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
namespace Aphera\Server\Adapter\TestAsset;

use Aphera\Model\ExtensibleElement;
use Aphera\Server\RequestContext;
use Aphera\Server\Adapter\AbstractEntityCollectionAdapter;


class StubEntityCollectionAdapter extends AbstractEntityCollectionAdapter
{
    public $testEntryByResourceName;
    
    public function getId() {
        throw new Exception('not implemented');
    }
    
    public function getAuthor() {
        throw new Exception('not implemented');
    }
    
    protected function getEntryByResourceName($name) {
        return $this->testEntryByResourceName;
    }

    protected function postEntryWithCollectionProvider($title, $id, $summary, \DateTime $updated, array $authors, $content, RequestContext $request)
    {
        
    }

    protected function putEntryWithCollectionProvider($entry, $title, $updated, array $authors, $summary, $content, RequestContext $request)
    {
        
    }

    public function getEntryAuthors(ExtensibleElement $entry)
    {
        
    }

    public function getEntryContent(ExtensibleElement $entry)
    {
        
    }

    public function getEntryId(ExtensibleElement $entry)
    {
        
    }

    public function getEntryTitle(ExtensibleElement $entry)
    {
        
    }

    public function getEntryUpdated(ExtensibleElement $entry)
    {
        
    }

    public function getFeed(RequestContext $request)
    {
        
    }

    public function getTitle(RequestContext $request)
    {
        
    }
}