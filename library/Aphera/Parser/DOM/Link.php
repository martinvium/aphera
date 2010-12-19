<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;
use Aphera\Core;

class Link extends ExtensibleElement implements Model\Link
{
    public function __construct(Core\Factory $factory) {
        parent::__construct(Core\Constants::LINK, null, Core\Constants::ATOM_NS, $factory);
    }
    
    public function setHref($value) {
        if($value) {
            $this->setAttributeNS(Core\Constants::ATOM_NS, Core\Constants::HREF, $value);
        }
    }
    
    public function getHref() {
        return $this->getAttributeNS(Core\Constants::ATOM_NS, Core\Constants::HREF);
    }
    
    public function setRel($value) {
        if($value) {
            $this->setAttributeNS(Core\Constants::ATOM_NS, Core\Constants::REL, $value);
        }
    }
    
    public function getRel() {
        return $this->getAttributeNS(Core\Constants::ATOM_NS, Core\Constants::REL);
    }
    
    public function setTitle($value) {
        if($value) {
            $this->setAttributeNS(Core\Constants::ATOM_NS, Core\Constants::TITLE, $value);
        }
    }
    
    public function getTitle() {
        return $this->getAttributeNS(Core\Constants::ATOM_NS, Core\Constants::TITLE);
    }
}