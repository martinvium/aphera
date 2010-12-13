<?php
namespace Aphera\Model;

/**
 * @todo missing accepts
 */
interface Collection extends ExtensibleElement
{
    public function getTitle();
    
    public function setTitle($title);
    
    public function getHref();
    
    public function getResolvedHref();
    
    public function setHref($href);
    
    public function getCategories();
    
    public function addCategories(array $categories);
}