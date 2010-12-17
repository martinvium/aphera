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
    
    public function newContent($type);
    
    public function newPublished();
    
    public function newUpdated();
    
    public function newID();
    
    public function newLink();
    
    public function newTitle();
    
    public function newSummary();
    
    public function newElement($local, $uri);
    
    public function registerExtension(ExtensionFactory $factory);
    
    public function getAphera();
}