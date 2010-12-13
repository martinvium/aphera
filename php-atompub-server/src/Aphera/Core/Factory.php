<?php
namespace Aphera\Core;

interface Factory
{
    public function newParser();
    
    public function newDocument();
    
    public function newService();
    
    public function newWorkspace();
    
    public function newCollection();
    
    public function newEntry();
    
    public function newFeed();
    
    public function newCategories();
    
    public function newCategory();
    
    public function newContent($type);
    
    public function newPublished();
    
    public function newUpdated();
    
    public function newGenerator();
    
    public function newID();
    
    public function newUri();
    
    public function newLink();
    
    public function newTitle();
    
    public function newSummary();
    
    public function newElement($qname);
    
    public function newExtensionElement($qname);
    
    public function registerExtension(ExtensionFactory $factory);
    
    public function newCategories();
    
    public function getAphera();
}