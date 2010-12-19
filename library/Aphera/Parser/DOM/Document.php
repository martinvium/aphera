<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;

class Document extends \DOMDocument implements Model\Document
{
    public function __construct() {
        parent::__construct(); // has to be called!
    }
    
    public function getRootEntry() {
        $this->registerNodeClass('DOMElement', '\\Aphera\\Parser\\DOM\\Entry');
        return $this->documentElement;
    }
    
    public function getRootFeed() {
        $this->registerNodeClass('DOMElement', '\\Aphera\\Parser\\DOM\\Feed');
        return $this->documentElement;
    }
}