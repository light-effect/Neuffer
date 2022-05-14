<?php

declare(strict_types=1);

namespace Neuffer\ValueObject;

use Neuffer\Enum\ActionEnum;
use Neuffer\Exception\UnsupportedActionException;

class ActionParam
{
    private string $action;

    private function __construct(string $action)
    {
        $this->action = $action;
    }

    /**
     * Create value object from string.
     *
     * @param string $action Action.
     *
     * @return $this
     *
     * @throws UnsupportedActionException
     */
    public static function createFromString(string $action): self
    {
        if (in_array($action, ActionEnum::ALLOWED_ACTIONS, true)) {
            return new self($action);
        }

        throw new UnsupportedActionException($action);
    }

    public function isAction(string $action): bool
    {
        return $this->action === $action;
    }

    public function toString(): string
    {
        return $this->action;
    }
}