<?php

declare(strict_types=1);

namespace Neuffer\ActionStrategy;

interface ActionInterface
{
    /**
     * Do action.
     *
     * @param int $a First number.
     * @param int $b Second number.
     *
     * @return int
     */
    public function action(int $a, int $b): int;
}