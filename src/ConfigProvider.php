<?php

declare(strict_types=1);

namespace Neuffer;

use Neuffer\Params\Factory\ParamsFactory;
use Neuffer\Params\ParamsInterface;

class ConfigProvider implements ConfigProviderInterface
{
    public function getFactories(): array
    {
        return [
            ParamsInterface::class => ParamsFactory::class,
        ];
    }
}