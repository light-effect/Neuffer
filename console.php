<?php

declare(strict_types=1);

use Neuffer\ActionStrategy\ActionInterface;
use Neuffer\Application\Application;
use Neuffer\ConfigProvider;
use Neuffer\Params\ParamsInterface;
use Neuffer\Service\FileServiceInterface;
use Neuffer\ServiceManager\ServiceManager;
use Psr\Log\LoggerInterface;

require __DIR__ . '/vendor/autoload.php';

$container = new ServiceManager([
    ConfigProvider::class,
]);

$app = new Application(
    $container->get(ParamsInterface::class),
    $container->get(ActionInterface::class),
    $container->get(FileServiceInterface::class),
    $container->get(LoggerInterface::class)
);

$app->run();
