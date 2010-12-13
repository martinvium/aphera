<?php
namespace Aphera\Core;

final class Constants
{
    const CONFIG_PARSER = "org.apache.abdera.parser.Parser";
    const CONFIG_FACTORY = "org.apache.abdera.factory.Factory";
    const CONFIG_XPATH = "org.apache.abdera.xpath.XPath";
    const CONFIG_PARSERFACTORY = "org.apache.abdera.parser.ParserFactory";
    const CONFIG_WRITERFACTORY = "org.apache.abdera.writer.WriterFactory";
    const CONFIG_WRITER = "org.apache.abdera.writer.Writer";
    const CONFIG_STREAMWRITER = "org.apache.abdera.writer.StreamWriter";
    const DEFAULT_PARSER = "org.apache.abdera.parser.stax.FOMParser";
    const DEFAULT_FACTORY = "org.apache.abdera.parser.stax.FOMFactory";
    const DEFAULT_XPATH = "org.apache.abdera.parser.stax.FOMXPath";
    const DEFAULT_PARSERFACTORY = "org.apache.abdera.parser.stax.FOMParserFactory";
    const DEFAULT_WRITERFACTORY = "org.apache.abdera.parser.stax.FOMWriterFactory";
    const DEFAULT_WRITER = "org.apache.abdera.parser.stax.FOMWriter";
    const DEFAULT_STREAMWRITER = "org.apache.abdera.parser.stax.StaxStreamWriter";
}