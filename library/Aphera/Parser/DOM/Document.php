<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;

class Document extends \DOMDocument implements Model\Document
{
    protected $factory;

    public function __construct(Factory $factory, $version, $encoding) {
        parent::__construct($version, $encoding); // has to be called!
        $this->factory = $factory;
    }
    
    public function getRootEntry() {
        $this->registerNodeClass('DOMElement', '\\Aphera\\Parser\\DOM\\Entry');
        $entry = $this->documentElement;
        $entry->setFactory($this->factory);
        return $entry;
    }
    
    public function getRootFeed() {
        $this->registerNodeClass('DOMElement', '\\Aphera\\Parser\\DOM\\Feed');
        $feed = $this->documentElement;
        $feed->setFactory($this->factory);
        return $feed;
    }
}