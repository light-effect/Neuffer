<?php

declare(strict_types=1);

namespace Integration;

use Neuffer\Application\Application;
use Neuffer\ConfigProvider;
use Neuffer\Enum\ActionEnum;
use Neuffer\Params\ParamsInterface;
use Neuffer\ServiceManager\ServiceManager;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Stubs\ConsoleHelper;
use Stubs\FileHelper;

class ConsoleTest extends TestCase
{
    private ContainerInterface $container;

    public function setUp(): void
    {
        FileHelper::$log = [];
        FileHelper::$result = [];
        FileHelper::$data = [];

        $this->container = new ServiceManager([
            ConfigProvider::class,
        ]);
    }

    public function testConsoleSum(): void
    {
        ConsoleHelper::$argv = [
            'action' => ActionEnum::SUM,
            'file' => 'test',
        ];

        FileHelper::$data = [
            [2, 2]
        ];

        (new Application($this->container->get(ParamsInterface::class)))->run();

        self::assertEquals(
            ["2;2;4\r\n"],
            FileHelper::$result
        );

        self::assertEquals(
            [
                "Started plus operation \r\n",
                "Finished plus operation \r\n",
            ],
            FileHelper::$log
        );
    }

    public function testConsoleMinus(): void
    {
        ConsoleHelper::$argv = [
            'action' => ActionEnum::MINUS,
            'file' => 'test',
        ];

        FileHelper::$data = [
            '4;2'
        ];

        (new Application($this->container->get(ParamsInterface::class)))->run();

        self::assertEquals(
            ["4;2;2\r\n"],
            FileHelper::$result
        );

        self::assertEquals(
            [
                "Started minus operation \r\n",
                "Finished minus operation \r\n",
            ],
            FileHelper::$log
        );
    }

    public function testConsoleMultiply(): void
    {
        ConsoleHelper::$argv = [
            'action' => ActionEnum::MULTIPLY,
            'file' => 'test',
        ];

        FileHelper::$data = [
            ['3;2']
        ];

        (new Application($this->container->get(ParamsInterface::class)))->run();

        self::assertEquals(
            ["3;2;6\r\n"],
            FileHelper::$result
        );

        self::assertEquals(
            [
                "Started multiply operation\r\n",
                "Finished multiply operation\r\n",
            ],
            FileHelper::$log
        );
    }

    public function testConsoleDivide(): void
    {
        ConsoleHelper::$argv = [
            'action' => ActionEnum::DIVISION,
            'file' => 'test',
        ];

        FileHelper::$data = [
            '9;3'
        ];

        (new Application($this->container->get(ParamsInterface::class)))->run();

        self::assertEquals(
            ["9;3;3\r\n"],
            FileHelper::$result
        );

        self::assertEquals(
            [
                "Started division operation \r\n",
                "Finished division operation \r\n",
            ],
            FileHelper::$log
        );
    }
}
