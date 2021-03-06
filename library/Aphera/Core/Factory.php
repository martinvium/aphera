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
namespace Aphera\Core;

use Aphera\Model;

interface Factory
{
    /**
     * @return Parser
     */
    public function newParser();

    /**
     * @return Model\Document
     */
    public function newDocument();

    public function newService();

    /**
     * @return Model\Workspace
     */
    public function newWorkspace(Model\ExtensibleElement $parent);

    /**
     * @return Model\Collection
     */
    public function newCollection(Model\ExtensibleElement $parent = null);

    /**
     * @return Writer
     */
    public function newWriter();
    
    /**
     * @param Model\ExtensibleElement $parent
     * @return Model\Entry
     */
    public function newEntry(Model\ExtensibleElement $parent = null);
    
    public function newFeed();
    
    public function newSource(Model\ExtensibleElement $parent = null);
    
    public function newCategories();
    
    public function newCategory();
    
    public function newContent(Model\ExtensibleElement $parent = null);
    
    public function newPublished();
    
    public function newUpdated();
    
    public function newID();
    
    /**
     * @return Model\Link
     */
    public function newLink(Model\ExtensibleElement $parent = null);
    
    public function newTitle();
    
    public function newSummary();
    
    public function newElement($local, $uri);
    
    public function registerExtension(ExtensionFactory $factory);
    
    public function getAphera();
}