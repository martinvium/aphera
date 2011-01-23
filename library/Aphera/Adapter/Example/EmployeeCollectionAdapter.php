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
namespace Aphera\Adapter\Example;

use Aphera\Server\Adapter\AbstractEntityCollectionAdapter;
use Aphera\Server\RequestContext;
use Aphera\Model\Entry;

class EmployeeCollectionAdapter extends AbstractEntityCollectionAdapter
{
    const ID_PREFIX = 'prefix';

    public static function getClass() {
        return __CLASS__;
    }

    public function getAuthor(RequestContext $request) {
        return "Acme Industries";
    }

    public function getId(RequestContext $request) {
        return "tag:acme.com,2007:employee:feed";
    }

    public function getTitle(RequestContext $request) {
        return "Acme Employee Database";
    }
    
    /**
     * @param Employee $entry
     * @return string 
     */
    public function getEntityId($entity) {
        return self::ID_PREFIX . $entity->getId();
    }

    /**
     * @param Employee $entry
     * @return stirng 
     */
    public function getEntityTitle($entry) {
        return $entry->getName();
    }

    /**
     * @param Employee $entry
     * @return \DateTime
     */
    public function getEntityUpdated($entry) {
        return $entry->getUpdated();
    }
    
    /**
     * @param Employee $entry 
     */
    public function getEntityAuthors($entry) {
        throw new \Exception('not implemented');
    }

    /**
     * @param Employee $entry 
     */
    public function getEntityContent($entry) {
        throw new \Exception('not implemented');
    }
    
    protected function getEntityFromResourceName($name, RequestContext $request) {
        $id = $this->getIdFromResourceName($name);
        return $this->employees[$id];
    }
    
    protected function getIdFromResourceName($name) {
        $pieces = explode('-', $name, 2);
        return $pieces[0];
    }
    
    public function getEntryName(Employee $entry) {
        return $entry->getId() . '-' . \str_replace(" ", "_", $entry->getName());
    }

    protected function postEntryWithCollectionProvider(Entry $entry, RequestContext $request) {
        $id = $entry->getId();
        if(! $id) {
            $id = \uniqid('entry');
        }

        $employee = new Employee();
        $employee->setId($id);
        $employee->setName($entry->getTitle());
        $employee->setUpdated($entry->getUpdated());
        $this->employees[$id] = $employee;
        return $employee;
    }
    
    /**
     * @param Employee $entity
     * @param RequestContext $request 
     */
    protected function putEntryWithCollectionProvider($origEntity, Entry $entry, RequestContext $request) {
        $origEntity->setName($entry->getTitle());
    }
    
    protected function deleteEntryWithCollectionProvider($name) {
        $id = $this->getIdFromResourceName($name);
        unset($this->employees[$id]);
    }

    /**
     * @param Employee $entity 
     */
    public function getEntityName($entity) {
        return $entity->getId() . '-' . \str_replace(" ", "_", $entity->getName());
    }

    public function getEmployees() {
        return $this->employees;
    }

    protected function getEntries(RequestContext $request) {
        return $this->employees;
    }
}