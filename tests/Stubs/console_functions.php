<?php

namespace Neuffer\Application;

use Stubs\ConsoleHelper;

function getopt(string $short_options, array $long_options = [])
{
    return ConsoleHelper::$argv;
}