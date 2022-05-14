<?php

declare(strict_types=1);

namespace Integration;

use Neuffer\ActionStrategy\ActionInterface;
use Neuffer\Application\Application;
use Neuffer\ConfigProvider;
use Neuffer\Enum\ActionEnum;
use Neuffer\Params\ParamsInterface;
use Neuffer\Service\FileServiceInterface;
use Neuffer\ServiceManager\ServiceManager;
use Neuffer\ValueObject\ActionParam;
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

    /**
     * @dataProvider consoleDataSets
     */
    public function testConsoleSum(string $action, array $fileData, array $expectedResult): void
    {
        $params = $this->createMock(ParamsInterface::class);
        $params->method('getActionParam')->willReturn(
            ActionParam::createFromString($action)
        );

        $this->container->replaceMap(ParamsInterface::class, static fn() => $params);

        $fileService = $this->createMock(FileServiceInterface::class);
        $fileService
            ->expects(self::once())
            ->method('fetchFileLines')
            ->willReturn($fileData);
        $fileService
            ->expects(self::once())
            ->method('writeToFile')
            ->with('result.csv', $expectedResult)
            ->willReturn(true);

        $app = new Application(
            $params,
            $this->container->get(ActionInterface::class),
            $fileService
        );

        $app->run();
    }

    public function consoleDataSets(): array
    {
        return [
            ActionEnum::SUM => [
                'action'         => ActionEnum::SUM,
                'fileData'       => ['2;2'],
                'expectedResult' => ['2;2;4'],
            ],
        ];
    }
}
