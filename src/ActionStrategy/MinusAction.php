<?php

declare(strict_types=1);

namespace Neuffer\ActionStrategy;

class MinusAction implements ActionInterface
{
    public function action(int $a, int $b): int
    {
        return $a - $b;
    }
}