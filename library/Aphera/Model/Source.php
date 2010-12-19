<?php
namespace Aphera\Model;

interface Source extends ExtensibleElement
{
    public function getIdElement();
    
    public function getId();
    
    public function setId($id);
    
    public function getLinks($rel = null);
    
    public function addLink($href, $rel = null, $title = null);
    
    public function getTitleElement();
    
    public function getTitle();
    
    public function setTitle($value);
}