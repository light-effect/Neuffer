<?php

declare(strict_types=1);

namespace Neuffer\ActionStrategy;

class MultiplyAction implements ActionInterface
{
    public function action(int $a, int $b): int
    {
        return $a * $b;
    }
}