<?php
use Aphera\Core;

$aphera = new Core\Aphera();

// server example
$ca = new EmployeeCollectionAdapter();
$ca->setHref("employee");

$wi = new SimpleWorkspaceInfo();
$wi->setTitle("Employee Directory Workspace");
$wi->addCollection($ca);

$provider = new DefaultProvider();
$provider->addWorkspace($wi);
$provider->init($aphera);

$provider->writeTo('php://output');


// parse example
$url = "http://www.example.org/feed";
$parser = $aphera->getParser();
$fp = fopen($url);

$doc = $parser->parse($fp, $url);
$feed = $doc->getRoot();

echo $feed->getTitle();
foreach($feed->getEntries() as $entry) {
    echo "\t" . $entry->getTitle();
}