<?php
/**
 * Copyright 2011 Martin Vium
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
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
    
    public function testWriteTo_EmptyEntry_WritesToStream() {
        $entry = $this->factory->newEntry();
        
        $this->writer->writeTo($entry, $this->stream);
        
        \rewind($this->stream);
        $xml = \stream_get_contents($this->stream);
        
        $this->assertContains('<?xml version="1.0" encoding="utf-8"?>', $xml);
        $this->assertContains('<entry xmlns="http://www.w3.org/2005/Atom"/>', $xml);
    }
    
    public function testWriteTo_NestedData_WritesToStream() {
        $entry = $this->factory->newEntry();
        $entry->setTitle('testtitle');
        
        $this->writer->writeTo($entry, $this->stream);
        
        \rewind($this->stream);
        $xml = \stream_get_contents($this->stream);
        $this->assertContains('<?xml version="1.0" encoding="utf-8"?>', $xml);
        $this->assertContains('<entry xmlns="http://www.w3.org/2005/Atom"><title>testtitle</title></entry>', $xml);
    }
}