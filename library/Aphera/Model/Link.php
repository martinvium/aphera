<?php
namespace Aphera\Model;

interface Link extends ExtensibleElement
{
    public function setHref($value);
    
    public function getHref();
    
    public function setRel($value);
    
    public function getRel();
    
    public function setTitle($value);
    
    public function getTitle();
}