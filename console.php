<?php

declare(strict_types=1);

use Neuffer\Application\Application;
use Neuffer\ConfigProvider;
use Neuffer\Params\ParamsInterface;
use Neuffer\ServiceManager\ServiceManager;

require __DIR__ . '/vendor/autoload.php';

$container = new ServiceManager([
    ConfigProvider::class,
]);

$app = new Application($container->get(ParamsInterface::class));

$app->run();
