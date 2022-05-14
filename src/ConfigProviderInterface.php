<?php

declare(strict_types=1);

namespace Neuffer;

interface ConfigProviderInterface
{
    public function getFactories(): array;
}