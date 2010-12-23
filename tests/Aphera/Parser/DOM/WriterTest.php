<?php
namespace Aphera\Parser\DOM;

use Aphera\Core\Aphera;

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/bootstrap.php');

class WriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Core\Factory
     */
    protected $factory;
    
    /**
     * @var Writer
     */
    protected $writer;
    
    protected $stream;
    
    public function setUp() {
        parent::setUp();
        
        $aphera = new Aphera();
        $this->factory = $aphera->getFactory();
        $this->writer = $this->factory->newWriter();
        $this->stream = fopen('php://memory', 'w');
    }
    
    public function testWriteTo_Scenario_Assertions() {
        $entry = $this->factory->newEntry();
        $entry->setTitle('testtitle');
        
        $this->writer->writeTo($entry, $this->stream);
        
        \rewind($this->stream);
        $xml = \stream_get_contents($this->stream);
        $this->assertContains('<?xml version="1.0"?>', $xml);
        $this->assertContains('<entry xmlns="http://www.w3.org/2005/Atom"><title>testtitle</title></entry>', $xml);
    }
}