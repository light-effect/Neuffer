<?php

declare(strict_types=1);

namespace Neuffer\ServiceManager;

use Psr\Container\ContainerInterface;

class ServiceManager implements ContainerInterface
{
    private array $map = [];

    /**
     * @param string[] $configProviders
     */
    public function __construct(array $configProviders)
    {
        foreach ($configProviders as $configProvider) {
            $this->map = array_merge($this->map, (new $configProvider())->getFactories());
        }
    }

    public function get(string $id)
    {
        return (new $this->map[$id])($this);
    }

    public function has(string $id): bool
    {
        return isset($this->map[$id]);
    }
}
