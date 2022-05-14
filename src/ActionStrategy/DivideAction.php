<?php

declare(strict_types=1);

namespace Neuffer\ActionStrategy;

use Exception;

class DivideAction implements ActionInterface
{
    public function action(int $a, int $b): int
    {
        if ($b === 0) {
            return 0;
        }

        $result = $a / $b;

        return (int) round($result);
    }
}