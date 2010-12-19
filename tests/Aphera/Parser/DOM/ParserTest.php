<?php
namespace Tests\Aphera\Parser\DOM;

use Aphera\Core;
use Aphera\Parser\DOM;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class ContentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DOM\Factory
     */
    protected $factory;
    
    protected $filesPath;
    
    /**
     * @var DOM\Parser
     */
    protected $parser;
    
    protected function setUp() {
        parent::setUp();
        
        $this->filesPath = dirname(__FILE__) . "/_files" . \DIRECTORY_SEPARATOR;
        
        $aphera = new Core\Aphera();
        $this->factory = $aphera->getFactory();
        $this->parser = $this->factory->newParser();
    }
    
    public function testParseStream_SimpleFeed_ReturnsFeedDocument() {
        $filename = $this->filesPath . "simpleFeed.xml";
        $fp = \fopen($filename, "r");
        
        $doc = $this->parser->parseStream($fp);
        
        $this->assertType('\\Aphera\\Model\\Document', $doc);
        $feed = $doc->getRootFeed();
        $this->assertType('\\Aphera\\Model\\Feed', $feed);
        $entries = $feed->getEntries();
        $this->assertEquals('urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a', $entries[0]->getId());
    }
    
    public function testParseStream_SimpleEntry_ReturnsEntryDocument() {
        $filename = $this->filesPath . "simpleEntry.xml";
        $fp = \fopen($filename, "r");
        
        $doc = $this->parser->parseStream($fp);
        
        $this->assertType('\\Aphera\\Model\\Document', $doc);
        $entry = $doc->getRootEntry();
        $this->assertType('\\Aphera\\Model\\Entry', $entry);
        $this->assertEquals('urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a', $entry->getId());
    }
    
    public function testParseString_SimpleEntry_ReturnsEntryDocument() {
        $filename = $this->filesPath . "simpleEntry.xml";
        
        $doc = $this->parser->parseString(\file_get_contents($filename));
        
        $this->assertType('\\Aphera\\Model\\Document', $doc);
        $entry = $doc->getRootEntry();
        $this->assertType('\\Aphera\\Model\\Entry', $entry);
        $this->assertEquals('urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a', $entry->getId());
    }
}