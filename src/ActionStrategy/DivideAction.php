<?php

declare(strict_types=1);

namespace Neuffer\ActionStrategy;

use Exception;

class DivideAction implements ActionInterface
{
    public function action(int $a, int $b): int
    {
        try {
            return $a / $b;
        } catch (Exception $exception) {
            return 0;
        }
    }
}