<?php
namespace Aphera\Model;

use Aphera\Model;

interface Content extends ExtensibleElement
{
    public function getContentType();
    
    public function setContentType($type);
    
    public function getSrc();
    
    public function getResolvedSrc();
    
    public function setSrc($src);
    
    public function setValue($value);
    
    public function getValueElement();
    
    public function setValueElement(Model\Element $element);
}