<?php
namespace Aphera\Server\Context;

use Aphera\Model\ExtensibleElement;
use Aphera\Core\Writer;

class EntityResponseContext extends AbstractResponseContext
{
    /**
     * @var ExtensibleElement
     */
    protected $entity;
    
    public function __construct(ExtensibleElement $entity) {
        $this->entity = $entity;
    }
    
    /**
     * @return ExtensibleElement
     */
    public function getEntity() {
        return $this->entity;
    }
    
    public function hasEntity() {
        return (bool)$this->entity;
    }

    public function writeTo($stream, Writer $writer = null) {
        if(! $writer) {
            $writer = $this->writer;
        }
        $writer->writeTo($this->getEntity(), $stream);
    }
}