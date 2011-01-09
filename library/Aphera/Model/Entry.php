<?php
namespace Aphera\Model;

interface Entry extends ExtensibleElement
{
    public function getContentElement();
    
    public function getContent();
    
    public function setContent($content);
    
    public function getIdElement();
    
    public function getId();
    
    public function setId($id);
    
    public function newId();
    
    public function getLinks($rel = null);
    
    public function addLink($href, $rel = null, $title = null);
    
    public function getSummaryElement();
    
    public function getSummary();
    
    public function setSummary($value);
    
    public function getTitleElement();
    
    public function getTitle();
    
    public function setTitle($value);

    public function getUpdated();

    public function setUpdated(\DateTime $datetime);
}