<?php

declare(strict_types=1);

namespace Neuffer\Params\Factory;

use Stubs\ConsoleHelper;

function getopt(string $short_options, array $long_options = [])
{
    return ConsoleHelper::$argv;
}
