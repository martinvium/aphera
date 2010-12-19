<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;
use Aphera\Core;

class Content extends ExtensibleElement implements Model\Content
{
    private $xmlTypes = array('xhtml', 'xml');
    
    public function __construct(Core\Factory $factory) {
        parent::__construct(Core\Constants::CONTENT, null, Core\Constants::ATOM_NS, $factory);
    }
    
    public function getContentType() {
        return $this->getAttributeNS(Core\Constants::ATOM_NS, Core\Constants::TYPE);
    }
    
    public function setContentType($type) {
        $this->setAttributeNS(Core\Constants::ATOM_NS, Core\Constants::TYPE, $type);
    }
    
    public function getSrc() {
        return $this->getAttributeNS(Core\Constants::ATOM_NS, Core\Constants::SRC);
    }
    
    public function getResolvedSrc() {
        throw new Exception('not implemented');
    }
    
    public function setSrc($src) {
        $this->setAttributeNS(Core\Constants::ATOM_NS, Core\Constants::SRC, $src);
    }
    
    public function setValue($value) {
        $this->nodeValue = (string)$value;
    }
    
    public function getValueElement() {
        $this->ownerDocument->registerNodeClass('DOMElement', 'Aphera\\Parser\\DOM\\Element');
        if(in_array($this->getContentType(), $this->xmlTypes)) {
            return $this->firstChild;
        } else {
            return null;
        }
    }
    
    public function setValueElement(Model\Element $element) {
        $this->appendChild($element);
    }
}