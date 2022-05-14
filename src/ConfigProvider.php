<?php

declare(strict_types=1);

namespace Neuffer;

use Neuffer\ActionStrategy\ActionInterface;
use Neuffer\ActionStrategy\Factory\ActionStrategyFactory;
use Neuffer\Params\Factory\ParamsFactory;
use Neuffer\Params\ParamsInterface;
use Neuffer\Service\Factory\FileServiceFactory;
use Neuffer\Service\FileServiceInterface;

class ConfigProvider implements ConfigProviderInterface
{
    public function getFactories(): array
    {
        return [
            ParamsInterface::class => ParamsFactory::class,
            ActionInterface::class => ActionStrategyFactory::class,
            FileServiceInterface::class => FileServiceFactory::class,
        ];
    }
}