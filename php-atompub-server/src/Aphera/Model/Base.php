<?php
namespace Aphera\Model;

interface Base
{
    public function writeTo(Writer $out);
    
    public function getFactory();    
}