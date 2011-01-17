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

use Aphera\Model\ExtensibleElement;
use Aphera\Server\RequestContext;
use Aphera\Server\Context\EmptyResponseContext;
use Aphera\Server\ProviderHelper;
use Aphera\Model\Entry;
use Aphera\Server\Context\ResponseContextException;
use Aphera\Server\Context\BasicResponseContext;
use Aphera\Server\ResponseContext;

abstract class AbstractEntityCollectionAdapter extends AbstractCollectionAdapter
{
    /**
     * @param RequestContext $request
     * @return ResponseContext
     */
    public function getEntry(RequestContext $request) {
        $name = $this->getResourceName($request);
        $entity = $this->getEntityFromResourceName($name, $request);
        if(! $entity) {
            return ProviderHelper::notFound($request);
        }

        $entry = $this->getEntryFromEntity($entity, $request);
        $response = new BasicResponseContext($entry);
        $response->setStatus(200);
        return $response;
    }

    /**
     * @param RequestContext $request
     * @return ResponseContext
     */
    public function postEntry(RequestContext $request) {
        try {
            $entry = $this->getEntryFromRequest($request);
            if(! $entry) {
                return new EmptyResponseContext(400);
            }

            $entry->setUpdated(new \DateTime());
            $entity = $this->postEntryWithCollectionProvider($entry, $request);

            $entry->setId($this->getEntityId($entity));
            return $this->buildCreateEntryResponse($entry);
        } catch(ResponseContextException $e) {
            return $this->createErrorResponse($e);
        }
    }

    /**
     * @param RequestContext $request
     * @return ResponseContext
     */
    public function putEntry(RequestContext $request) {
        try {
            $name = $this->getResourceName($request);
            $origEntity = $this->getEntityFromResourceName($name, $request);
            if(! $origEntity) {
                return ProviderHelper::notFound($request);
            }

            $origEntry = $this->getEntryFromEntity($origEntity, $request);
            if(! $origEntry) {
                return ProviderHelper::notFound($request);
            }

            $entry = $this->getEntryFromRequest($request);
            if(! $entry) {
                return new EmptyResponseContext(400);
            }

            if($origEntry->getId() != $entry->getId()) {
                return new EmptyResponseContext(409);
            }

            $entry->setUpdated(new \DateTime());
            $this->putEntryWithCollectionProvider(
                $origEntity,
                $entry,
                $request
            );

            return new EmptyResponseContext(204);
        } catch(ResponseContextException $e) {
            return $this->createErrorResponse($e);
        }
    }
    
    /**
     * @todo missing data
     * @return Entry
     */
    protected function getEntryFromEntity($entity, RequestContext $request) {
        $factory = $request->getAphera()->getFactory();
        $entry = $factory->newEntry();
        $entry->setId($this->getEntityId($entity));
        $entry->setTitle($this->getEntityTitle($entity));
        $entry->setUpdated($this->getEntityUpdated($entity));
        return $entry;
    }

    /**
     * @return Entry
     */
    protected abstract function putEntryWithCollectionProvider($origEntity, Entry $entry, RequestContext $request);
    
    protected abstract function postEntryWithCollectionProvider(Entry $entry, RequestContext $request);

    public function headEntry(RequestContext $request) {
        $name = $this->getResourceName($request);
        $entity = $this->getEntityFromResourceName($name, $request);
        if(! $entity) {
            return ProviderHelper::notFound($request);
        }

        return $this->getHeadEntryResponse($request, $name, $this->getEntityUpdated($entity));
    }
    
    protected function getHeadEntryResponse(RequestContext $request, $name, $updated) {
        return new EmptyResponseContext(200);
    }
    
    /**
     * @return Entry
     */
    protected abstract function getEntityFromResourceName($name, RequestContext $request);
    
    protected abstract function getIdFromResourceName($name);
    
    /**
     * Unique identifier
     */
    public abstract function getEntityId($entity);
    
    /**
     * Used to construct urls
     */
    public abstract function getEntityName($entity);
    
    public abstract function getEntityTitle($entity);
    
    public abstract function getEntityUpdated($entity);
    
    public abstract function getEntityAuthors($entity);
    
    public abstract function getEntityContent($entity);
}