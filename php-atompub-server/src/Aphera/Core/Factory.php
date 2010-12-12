<?php
namespace Aphera\Core;

interface Factory
{
    public function newEntry();
    
    public function newFeed();
    
    public function newService();
    
    public function newCategories();
    
    public function newCategory();
    
    public function newWorkspace();
    
    public function newCollection();
}