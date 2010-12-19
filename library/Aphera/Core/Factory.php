<?php
namespace Aphera\Core;

use Aphera\Model;

interface Factory
{
    public function newParser();
    
    public function newDocument();
    
    public function newService();
    
    public function newWorkspace();
    
    public function newCollection();
    
    /**
     * @return Model\Entry
     */
    public function newEntry();
    
    public function newFeed();
    
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