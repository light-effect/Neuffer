<?php

declare(strict_types=1);

namespace Neuffer\Params;

use Neuffer\ValueObject\ActionParam;

class Params implements ParamsInterface
{
    private ActionParam $actionParam;

    private string $fileParam;

    public function __construct(ActionParam $actionParam, string $fileParam)
    {
        $this->actionParam = $actionParam;
        $this->fileParam   = $fileParam;
    }

    public function getActionParam(): ActionParam
    {
        return $this->actionParam;
    }

    public function getFileParam(): string
    {
        return $this->fileParam;
    }
}