<?php

declare(strict_types=1);

namespace Neuffer\ActionStrategy\Factory;

use Neuffer\ActionStrategy\ActionInterface;
use Neuffer\ActionStrategy\DivideAction;
use Neuffer\ActionStrategy\MinusAction;
use Neuffer\ActionStrategy\MultiplyAction;
use Neuffer\ActionStrategy\SumAction;
use Neuffer\Enum\ActionEnum;
use Neuffer\Exception\UnsupportedActionException;
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
            case ActionEnum::MINUS:
                return new MinusAction();
            case ActionEnum::MULTIPLY:
                return new MultiplyAction();
            case ActionEnum::DIVISION:
                return new DivideAction();
            default:
                throw new UnsupportedActionException();
        }
    }
}