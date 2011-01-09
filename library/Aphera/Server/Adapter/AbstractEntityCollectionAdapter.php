<?php
namespace Aphera\Server\Adapter;

use Aphera\Model\ExtensibleElement;
use Aphera\Server\RequestContext;
use Aphera\Server\Context\EmptyResponseContext;
use Aphera\Server\ProviderHelper;
use Aphera\Model\Entry;

abstract class AbstractEntityCollectionAdapter extends AbstractCollectionAdapter
{    
    public function postEntry(RequestContext $request) {
        $entry = $this->getEntryFromRequest($request);
        if(! $entry) {
            return new EmptyResponseContext(400);
        }
        
        $entry->setUpdated(new \DateTime());
        $entity = $this->postEntryWithCollectionProvider($entry, $request);

        $entry->setId($this->getEntityId($entity));
        return $this->buildCreateEntryResponse($entry);
    }
    
    public function putEntry(RequestContext $request) {
        $name = $this->getResourceName($request);
        $origEntity = $this->getEntityFromResourceName($name, $request);
        if(! $origEntity) {
            return new EmptyResponseContext(404);
        }
        
        $origEntry = $this->getEntryFromEntity($origEntity, $request);
        if($origEntry) {
            $entry = $this->getEntryFromRequest($request);
            if($entry) {
                if($origEntry->getId() != $entry->getId())
                    return new EmptyResponseContext(409);

                $entry->setUpdated(new \DateTime());
                $this->putEntryWithCollectionProvider(
                    $origEntity, 
                    $entry,
                    $request
                );
                
                return new EmptyResponseContext(204);
            } else {
                return new EmptyResponseContext(400);
            }
        } else {
            return new EmptyResponseContext(404);
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
        $entry = $this->getEntryByResourceName($name);
        if($entry) {
            return $this->getHeadEntryResponse($request, $name, $this->getEntryUpdated($entry));
        } else {
            return ProviderHelper::notFound($request);
        }
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