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
namespace Aphera\Core;

final class Constants
{
    const CONFIG_PARSER = "Aphera\\Core\\Parser";
    const CONFIG_FACTORY = "Aphera\\Core\\Factory";
//    const CONFIG_XPATH = "org.apache.abdera.xpath.XPath";
//    const CONFIG_PARSERFACTORY = "org.apache.abdera.parser.ParserFactory";
//    const CONFIG_WRITERFACTORY = "org.apache.abdera.writer.WriterFactory";
    const CONFIG_WRITER = "Aphera\\Core\\Writer";
    
    const DEFAULT_PARSER = "Aphera\\Parser\\DOM\\Parser";
    const DEFAULT_FACTORY = "Aphera\\Parser\\DOM\\Factory";
//    const DEFAULT_XPATH = "org.apache.abdera.parser.stax.FOMXPath";
//    const DEFAULT_PARSERFACTORY = "org.apache.abdera.parser.stax.FOMParserFactory";
//    const DEFAULT_WRITERFACTORY = "org.apache.abdera.parser.stax.FOMWriterFactory";
    const DEFAULT_WRITER = "Aphera\\Parser\\DOM\\Writer";
//    const DEFAULT_STREAMWRITER = "org.apache.abdera.parser.stax.StaxStreamWriter";
    
    const ATOM_NS = "http://www.w3.org/2005/Atom";
    const APP_NS = "http://www.w3.org/2007/app";
    
    const FEED = "feed";
    const ENTRY = "entry";
    const SOURCE = "source";
    const CONTENT = "content";
    const SUMMARY = "summary";
    const ID = "id";
    const TITLE = "title";
    const LINK = "link";
    const HREF= "href";
    const REL = "rel";
    const TYPE = "type";
    const SRC = "src";
    const UPDATED = "updated";
    const WORKSPACE = "workspace";
    const COLLECTION = "collection";
    const ACCEPT = "accept";

    const DATE_FORMAT = 'c';
}