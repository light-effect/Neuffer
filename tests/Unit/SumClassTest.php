<?php

declare(strict_types=1);

namespace Unit;

use Neuffer\ClassOne;
use PHPUnit\Framework\TestCase;
use Stubs\FileHelper;

class SumClassTest extends TestCase
{
    public function setUp(): void
    {
        FileHelper::$log = [];
        FileHelper::$result = [];
        FileHelper::$data = [];
    }

    /**
     * @dataProvider dataSetsProvider
     */
    public function testWithCorrectNumbers(array $data, array $expectedResult, array $expectedLog): void
    {
        FileHelper::$data = $data;

        new ClassOne('sum_correct');

        self::assertEquals($expectedResult, FileHelper::$result);
        self::assertEquals($expectedLog, FileHelper::$log);
    }

    public function dataSetsProvider(): array
    {
        return [
            'sum_correct' => [
                'data' => [
                    [2, 2],
                ],
                'expectedResult' => [
                    "2;2;4\r\n",
                ],
                'expectedLog' => [
                    "Started plus operation \r\n",
                    "Finished plus operation \r\n",
                ],
            ],
            'sum_incorrect' => [
                'data' => [
                    [-2, -2],
                ],
                'expectedResult' => [
                ],
                'expectedLog' => [
                    "Started plus operation \r\n",
                    "numbers -2 and -2 are wrong \r\n",
                    "Finished plus operation \r\n",
                ],
            ],
            'sum_is_zero' => [
                'data' => [
                    [-2, 2],
                ],
                'expectedResult' => [
                    "-2;2;0\r\n"
                ],
                'expectedLog' => [
                    "Started plus operation \r\n",
                    "Finished plus operation \r\n",
                ],
            ],
        ];
    }
}
