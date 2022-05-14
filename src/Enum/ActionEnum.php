<?php

declare(strict_types=1);

namespace Neuffer\Enum;

class ActionEnum
{
    public const SUM      = 'plus';
    public const MINUS    = 'minus';
    public const MULTIPLY = 'multiply';
    public const DIVISION = 'division';

    public const ALLOWED_ACTIONS = [
        self::SUM,
        self::MINUS,
        self::MULTIPLY,
        self::DIVISION,
    ];
}