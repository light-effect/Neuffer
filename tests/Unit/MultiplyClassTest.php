<?php

declare(strict_types=1);

namespace Unit;

use Neuffer\Classthree;
use PHPUnit\Framework\TestCase;
use Stubs\FileHelper;

class MultiplyClassTest extends TestCase
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

        $subject = new Classthree();

        $subject->setFile('multiple');
        $subject->execute();

        self::assertEquals($expectedResult, FileHelper::$result);
        self::assertEquals($expectedLog, FileHelper::$log);
    }

    public function dataSetsProvider(): array
    {
        return [
            'multiply_correct' => [
                'data' => [
                    ['3;2'],
                ],
                'expectedResult' => [
                    "3;2;6\r\n",
                ],
                'expectedLog' => [
                    "Started multiply operation\r\n",
                    "Finished multiply operation\r\n",
                ],
            ],
            'multiply_incorrect' => [
                'data' => [
                    ['2;-4'],
                ],
                'expectedResult' => [
                ],
                'expectedLog' => [
                    "Started multiply operation\r\n",
                    "numbers 2 and -4 are wrong\r\n",
                    "Finished multiply operation\r\n",
                ],
            ],
            'multiply_is_zero' => [
                'data' => [
                    ['2;0'],
                ],
                'expectedResult' => [
                ],
                'expectedLog' => [
                    "Started multiply operation\r\n",
                    "numbers 2 and 0 are wrong\r\n",
                    "Finished multiply operation\r\n",
                ],
            ],
        ];
    }
}
