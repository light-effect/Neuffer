<?php

declare(strict_types=1);

namespace Unit\ValueObject;

use Neuffer\Exception\UnsupportedActionException;
use Neuffer\ValueObject\ActionParam;
use PHPUnit\Framework\TestCase;

class ActionParamTest extends TestCase
{
    public function testUnSupportActionParam(): void
    {
        self::expectException(UnsupportedActionException::class);

        ActionParam::createFromString('double');
    }
}