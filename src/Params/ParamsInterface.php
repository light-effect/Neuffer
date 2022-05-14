<?php

declare(strict_types=1);

namespace Neuffer\Params;

use Neuffer\ValueObject\ActionParam;

interface ParamsInterface
{
    public function getActionParam(): ActionParam;

    public function getFileParam(): string;
}