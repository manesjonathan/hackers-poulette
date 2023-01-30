<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require __DIR__ . '/../../vendor/autoload.php';
$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();