<?php
namespace Aphera\Client;

use Aphera\Model\Document;
use Aphera\Core\Parser;

interface ClientResponse
{
    /**
     * @return string
     */
    public function getMethod();
    
    /**
     * @return string
     */
    public function getUri();
    
    /**
     * @return Document
     */
    public function getDocument(Parser $parser = null);
    
    /**
     * @param resource $stream
     */
    public function setInputStream($stream);
}