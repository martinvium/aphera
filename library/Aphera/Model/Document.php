<?php
namespace Aphera\Model;

interface Document
{
    /**
     * @return Feed
     */
    public function getRootFeed();
    
    /**
     * @return Entry
     */
    public function getRootEntry();
}