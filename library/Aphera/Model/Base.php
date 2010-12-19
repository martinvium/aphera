<?php
namespace Aphera\Model;

use Aphera\Core;

interface Base
{
    public function writeTo(Core\Writer $out);
    
    public function getFactory();    
}