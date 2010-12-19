<?php
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
    
    const CONTENT = "content";
    const SUMMARY = "summary";
    const ID = "id";
    const TITLE = "title";
    const LINK = "link";
    const HREF= "href";
    const REL = "rel";
}