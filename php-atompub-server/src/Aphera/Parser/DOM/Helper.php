<?php
namespace Aphera\Parser\DOM;

class Helper
{
    /**
     * @param array $elements
     * @param string $name
     * @param string $value
     * @param string $namespaceUri
     * @return array of Model\Element
     */
    public static function getFilteredElementsByAttribute(array $elements, $name, $value, $namespaceUri) {
        $filteredElements = array();
        foreach($elements as $element) {
            if($element->getAttributeNS($namespaceUri, $name) == $value) {
                $filteredElements[] = $element;
            }
        }
        
        return $filteredElements;
    }
}