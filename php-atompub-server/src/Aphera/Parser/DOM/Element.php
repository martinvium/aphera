<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;

class Element extends \DOMElement implements Model\Element
{
    public function __construct ($name, $value, $uri) {
        parent::__construct($name, $value, $uri);
    }
}