<?php

declare(strict_types=1);

namespace Unit\ActionStrategy;

use Neuffer\ActionStrategy\DivideAction;
use PHPUnit\Framework\TestCase;

class DivideActionTest extends TestCase
{
    public function testDivideByZero(): void
    {
        $subject = new DivideAction();

        $result = $subject->action(0, 4);

        self::assertEquals(0, $result);

        $result = $subject->action(4, 0);

        self::assertEquals(0, $result);
    }
}