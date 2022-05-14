<?php

declare(strict_types=1);

namespace Neuffer\ActionStrategy\Factory;

use Neuffer\ActionStrategy\ActionInterface;
use Neuffer\ActionStrategy\SumAction;
use Neuffer\Enum\ActionEnum;
use Neuffer\Params\ParamsInterface;
use Psr\Container\ContainerInterface;

class ActionStrategyFactory
{
    public function __invoke(ContainerInterface $container): ActionInterface
    {
        $params = $container->get(ParamsInterface::class);

        switch ($params->getActionParam()->toString()) {
            case ActionEnum::SUM:
                return new SumAction();
        }

        throw new \Exception();
    }
}