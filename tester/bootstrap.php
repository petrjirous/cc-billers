<?php

require __DIR__ . '/../vendor/autoload.php';

$loader = new \Nette\Loaders\RobotLoader();

$loader->addDirectory(__DIR__ . '/../Billers');

$loader->setCacheStorage(new \Nette\Caching\Storages\FileStorage(__DIR__ . '/../cache'));

$loader->register();