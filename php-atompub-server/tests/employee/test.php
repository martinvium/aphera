<?php
use Aphera\Server;
use Aphera\Core;

$aphera = new Core\Aphera();

$ca = new EmployeeCollectionAdapter();
$ca->setHref("employee");

$wi = new SimpleWorkspaceInfo();
$wi->setTitle("Employee Directory Workspace");
$wi->addCollection($ca);

$provider = new DefaultProvider();
$provider->addWorkspace($wi);
$provider->init($aphera);

$provider->writeTo('php://output');