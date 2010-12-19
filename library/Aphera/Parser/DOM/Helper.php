<?php
namespace Aphera\Parser\DOM;

class Helper
{
    /**
     * @param array $elements
     * @param string $name
     * @param string $value
     * @param string $uri
     * @return array of Model\Element
     */
    public static function getElementsWithAttributeValue(array $elements, $name, $value, $uri = null) {
        $filteredElements = array();
        foreach($elements as $element) {
            if($element->getAttributeNS($uri, $name) == $value) {
                $filteredElements[] = $element;
            }
        }
        return $filteredElements;
    }
    
    /**
     * @param array $elements
     * @param string $name
     * @param string $value
     * @param string $uri
     * @return array of Model\Element
     */
    public static function getElementsWithChildElementValue(array $elements, $name, $value, $uri = null) {
        $filteredElements = array();
        foreach($elements as $element) {
            $idElement = $element->getFirstChildByTagName($name, $uri);
            if($idElement && $idElement->getValue() == $value) {
                $filteredElements[] = $element;
            }
        }
        return $filteredElements;
    }
    
    /**
     * @param array $elements
     * @param string $name
     * @param string $value
     * @param string $uri
     * @return array of Model\Element
     */
    public static function getFirstElementWithChildElementValue(array $elements, $name, $value, $uri = null) {
        $filteredElements = self::getElementsWithChildElementValue($elements, $name, $value, $uri);
        if(count($filteredElements)) {
            return $filteredElements[0];
        } else {
            return null;
        }
    }
}