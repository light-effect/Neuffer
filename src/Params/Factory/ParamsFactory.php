<?php

declare(strict_types=1);

namespace Neuffer\Params\Factory;

use Neuffer\Params\Params;
use Neuffer\Params\ParamsInterface;
use Neuffer\ValueObject\ActionParam;
use Psr\Container\ContainerInterface;

class ParamsFactory
{
    private const SHORT_OPTIONS = 'a:f:';

    private const LONG_OPTIONS = [
        'action:',
        'file:',
    ];

    public function __invoke(ContainerInterface $container): ParamsInterface
    {
        $options = getopt(self::SHORT_OPTIONS, self::LONG_OPTIONS);

        return new Params(
            ActionParam::createFromString($options['a'] ?? $options['action'] ?? 'unknown'),
            $options['f'] ?? $options['file'] ?? ''
        );
    }
}