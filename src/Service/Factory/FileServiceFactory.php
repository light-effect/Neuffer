<?php

declare(strict_types=1);

namespace Neuffer\Service\Factory;

use Neuffer\Service\FileService;
use Neuffer\Service\FileServiceInterface;
use Psr\Container\ContainerInterface;

class FileServiceFactory
{
    public function __invoke(ContainerInterface $container): FileServiceInterface
    {
        return new FileService();
    }
}