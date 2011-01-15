<?php
/**
 * Copyright 2011 Martin Vium
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
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