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
use Psr\Log\LoggerInterface;

class ConsoleTest extends TestCase
{
    private ContainerInterface $container;

    public function setUp(): void
    {
        $this->container = new ServiceManager([
            ConfigProvider::class,
        ]);
    }

    /**
     * @dataProvider consoleCorrectDataSets
     */
    public function testConsoleWithCorrectData(string $action, array $fileData, array $expectedResult): void
    {
        $params = $this->getParams($action);

        $fileService = $this->createMock(FileServiceInterface::class);
        $fileService
            ->expects(self::once())
            ->method('fetchFileLines')
            ->willReturn($fileData);
        $fileService
            ->expects(self::exactly(3))
            ->method('writeToFile')
            ->withConsecutive(
                [$this->getLogFilename(), ['Started ' . $action . ' operation']],
                [Application::RESULT_FILE, $expectedResult],
                [$this->getLogFilename(), ['Finished ' . $action . ' operation']],
            )
            ->willReturn(true);

        $this->container->replaceMap(ParamsInterface::class, static fn() => $params);
        $this->container->replaceMap(FileServiceInterface::class, static fn() => $fileService);

        $app = new Application(
            $params,
            $this->container->get(ActionInterface::class),
            $this->container->get(FileServiceInterface::class),
            $this->container->get(LoggerInterface::class)
        );

        $app->run();
    }


    /**
     * @dataProvider consoleIncorrectDataSets
     */
    public function testConsoleWithIncorrectData(string $action, array $fileData, array $expectedResult): void
    {
        $params = $this->getParams($action);

        $fileService = $this->createMock(FileServiceInterface::class);
        $fileService
            ->expects(self::once())
            ->method('fetchFileLines')
            ->willReturn($fileData);
        $fileService
            ->expects(self::exactly(3))
            ->method('writeToFile')
            ->withConsecutive(
                [$this->getLogFilename(), ['Started ' . $action . ' operation']],
                [$this->getLogFilename(), $expectedResult],
                [$this->getLogFilename(), ['Finished ' . $action . ' operation']],
            )
            ->willReturn(true);

        $this->container->replaceMap(ParamsInterface::class, static fn() => $params);
        $this->container->replaceMap(FileServiceInterface::class, static fn() => $fileService);

        $app = new Application(
            $params,
            $this->container->get(ActionInterface::class),
            $this->container->get(FileServiceInterface::class),
            $this->container->get(LoggerInterface::class)
        );

        $app->run();
    }

    private function getLogFilename(): string
    {
        return str_replace('tests\Integration', '', __DIR__) .
            'src\Logger\Factory/../../../log.txt';
    }


    private function getParams(string $action): ParamsInterface
    {
        $params = $this->createMock(ParamsInterface::class);
        $params->method('getActionParam')->willReturn(
            ActionParam::createFromString($action)
        );

        return $params;
    }

    public function consoleCorrectDataSets(): array
    {
        return [
            ActionEnum::SUM => [
                'action'         => ActionEnum::SUM,
                'fileData'       => ['2;2'],
                'expectedResult' => ['2;2;4'],
            ],
            ActionEnum::MINUS => [
                'action'         => ActionEnum::MINUS,
                'fileData'       => ['4;2'],
                'expectedResult' => ['4;2;2'],
            ],
            ActionEnum::MULTIPLY => [
                'action'         => ActionEnum::MULTIPLY,
                'fileData'       => ['3;2'],
                'expectedResult' => ['3;2;6'],
            ],
            ActionEnum::DIVISION => [
                'action'         => ActionEnum::DIVISION,
                'fileData'       => ['9;3'],
                'expectedResult' => ['9;3;3'],
            ],
        ];
    }

    public function consoleIncorrectDataSets(): array
    {
        return [
            ActionEnum::SUM => [
                'action'         => ActionEnum::SUM,
                'fileData'       => ['-2;-2'],
                'expectedResult' => ['numbers -2 and -2 are wrong'],
            ],
            ActionEnum::MINUS => [
                'action'         => ActionEnum::MINUS,
                'fileData'       => ['2;4'],
                'expectedResult' => ['numbers 2 and 4 are wrong'],
            ],
            ActionEnum::MULTIPLY => [
                'action'         => ActionEnum::MULTIPLY,
                'fileData'       => ['-3;2'],
                'expectedResult' => ['numbers -3 and 2 are wrong'],
            ],
            ActionEnum::DIVISION => [
                'action'         => ActionEnum::DIVISION,
                'fileData'       => ['0;3'],
                'expectedResult' => ['numbers 0 and 3 are wrong'],
            ],
        ];
    }
}
