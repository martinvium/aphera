<?php
namespace Aphera\Model;

interface Feed extends ExtensibleElement
{
    /**
     * @return array of Entry
     */
    public function getEntries();
    
    /**
     * Add entry to the END of the feed
     * 
     * @param Entry $entry if null an empty entry is added
     * @return Entry
     */
    public function addEntry(Entry $entry = null);
    
    /**
     * Add entry to the START of the feed
     * 
     * @param Entry $entry if null an empty entry is added
     * @return Entry
     */
    public function insertEntry(Entry $entry = null);
    
    /**
     * Get the first entry matching the passed id
     * 
     * @return Entry
     */
    public function getEntry($id);
}