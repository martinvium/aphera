<?php
namespace Tests\Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Parser\DOM;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class FeedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Core\Factory
     */
    protected $factory;
    
    /**
     * @var Model\Feed
     */
    protected $feed;
    
    protected function setUp() {
        parent::setUp();
        
        $aphera = new Core\Aphera();
        $this->factory = $aphera->getFactory();
        $this->feed = $this->factory->newFeed();
    }
    
    public function testAddEntry_NoEntryPassed_ReturnsAddedEntry() {
        $this->changeFeedAddEmptyEntries();
        
        $entry = $this->factory->newEntry();
        $entry->setId("test4");
        $returnedEntry = $this->feed->addEntry($entry);
        
        $this->assertEquals("test4", $returnedEntry->getId());
    }
    
    public function testAddEntry_PassMyEntry_AddedLast() {
        $this->changeFeedAddEmptyEntries();
        
        $entry = $this->factory->newEntry();
        $entry->setId("test4");
        $this->feed->addEntry($entry);
        
        $entries = $this->feed->getEntries();
        $this->assertEquals("test4", $entries[3]->getId());
    }
    
    public function testGetEntries_RegularFeed_ReturnsAllEntries() {
        $this->changeFeedAddEmptyEntries();
        $entries = $this->feed->getEntries();
        $this->assertEquals(3, count($entries));
    }
    
    public function testGetEntries_EmptyFeed_ReturnsEmptyArray() {
        $entries = $this->feed->getEntries();
        $this->assertEquals(0, count($entries));
    }
    
    public function testGetEntry_OneMatch_ReturnsMatchedEntry() {
        $this->changeFeedAddEmptyEntries();
        $entry = $this->feed->getEntry('test2');
        $this->assertEquals('test2', $entry->getId());
    }
    
    public function testGetEntry_NoEntryWithId_ReturnsNull() {
        $entry = $this->feed->getEntry('test2');
        $this->assertNull($entry);
    }
    
    public function changeFeedAddEmptyEntries() {
        $this->feed->addEntry()->setId('test1');
        $this->feed->addEntry()->setId('test2');
        $this->feed->addEntry()->setId('test3');
    }
}