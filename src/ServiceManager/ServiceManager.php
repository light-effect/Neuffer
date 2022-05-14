<?php

declare(strict_types=1);

namespace Neuffer\ServiceManager;

use Neuffer\Exception\ContainerNotFoundException;
use Neuffer\Exception\UnsupportedContainerException;
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
        if ($this->has($id) === false) {
            throw new ContainerNotFoundException();
        }

        if (is_callable($this->map[$id])) {
            return $this->map[$id]($this);
        }

        if (is_string($this->map[$id])) {
            return (new $this->map[$id])($this);
        }

        throw new UnsupportedContainerException();
    }

    public function replaceMap(string $id, $map): void
    {
        if (is_callable($map) === false && is_string($map) === false) {
            throw new UnsupportedContainerException();
        }

        $this->map[$id] = $map;
    }

    public function has(string $id): bool
    {
        return isset($this->map[$id]);
    }
}
