<?php
namespace Aphera\Parser\DOM;

use Aphera\Model;

class Document extends \DOMDocument implements Model\Document
{
    public function __construct() {
        parent::__construct(); // has to be called!
    }
}