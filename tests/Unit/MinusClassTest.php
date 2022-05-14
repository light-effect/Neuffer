<?php

declare(strict_types=1);

namespace Unit;

use Neuffer\ClassTwo;
use PHPUnit\Framework\TestCase;
use Stubs\FileHelper;

class MinusClassTest extends TestCase
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

        $result = new ClassTwo('minus');

        $result->start();

        self::assertEquals($expectedResult, FileHelper::$result);
        self::assertEquals($expectedLog, FileHelper::$log);
    }

    public function dataSetsProvider(): array
    {
        return [
            'minus_correct' => [
                'data' => [
                    '4;2',
                ],
                'expectedResult' => [
                    "4;2;2\r\n",
                ],
                'expectedLog' => [
                    "Started minus operation \r\n",
                    "Finished minus operation \r\n",
                ],
            ],
            'minus_incorrect' => [
                'data' => [
                    '2;4',
                ],
                'expectedResult' => [
                ],
                'expectedLog' => [
                    "Started minus operation \r\n",
                    "numbers 2 and 4 are wrong \r\n",
                    "Finished minus operation \r\n",
                ],
            ],
            'minus_is_zero' => [
                'data' => [
                    '2;2',
                ],
                'expectedResult' => [
                    "2;2;0\r\n"
                ],
                'expectedLog' => [
                    "Started minus operation \r\n",
                    "Finished minus operation \r\n",
                ],
            ],
        ];
    }
}
