<?php

declare(strict_types=1);

namespace Unit;

use Neuffer\ClassFour;
use PHPUnit\Framework\TestCase;
use Stubs\FileHelper;

class DivideClassTest extends TestCase
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

        new ClassFour('sum_correct');

        self::assertEquals($expectedResult, FileHelper::$result);
        self::assertEquals($expectedLog, FileHelper::$log);
    }

    public function dataSetsProvider(): array
    {
        return [
            'divide_correct' => [
                'data' => [
                    '9;3',
                ],
                'expectedResult' => [
                    "9;3;3\r\n",
                ],
                'expectedLog' => [
                    "Started division operation \r\n",
                    "Finished division operation \r\n",
                ],
            ],
            'divide_incorrect' => [
                'data' => [
                    '-4;2',
                ],
                'expectedResult' => [
                ],
                'expectedLog' => [
                    "Started division operation \r\n",
                    "numbers -4 and 2 are wrong \r\n",
                    "Finished division operation \r\n",
                ],
            ],
            'divide_is_zero' => [
                'data' => [
                    '0;2',
                ],
                'expectedResult' => [
                    "0;2;0\r\n"
                ],
                'expectedLog' => [
                    "Started division operation \r\n",
                    "Finished division operation \r\n",
                ],
            ],
        ];
    }
}
