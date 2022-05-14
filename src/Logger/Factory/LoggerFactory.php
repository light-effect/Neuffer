<?php

declare(strict_types=1);

namespace Neuffer\Logger\Factory;

use Neuffer\Logger\Logger;
use Neuffer\Service\FileServiceInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class LoggerFactory
{
    public function __invoke(ContainerInterface $container): LoggerInterface
    {
        $logFile = __DIR__ . '/../../../log.txt';

        return new Logger($container->get(FileServiceInterface::class), $logFile);
    }
}