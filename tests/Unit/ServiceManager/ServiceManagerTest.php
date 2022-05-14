<?php

declare(strict_types=1);

namespace Unit\ServiceManager;

use Neuffer\ConfigProviderInterface;
use Neuffer\Exception\ContainerNotFoundException;
use Neuffer\Exception\UnsupportedContainerException;
use Neuffer\ServiceManager\ServiceManager;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class ServiceManagerTest extends TestCase
{
    private ContainerInterface $subject;

    public function setUp(): void
    {
        $factory = $this->createMock(ConfigProviderInterface::class);

        $this->subject = new ServiceManager([
            'classA' => get_class($factory),
        ]);
    }

    public function testContainerNotFound(): void
    {
        self::expectException(ContainerNotFoundException::class);

        $this->subject->get('classB');
    }

    public function testReplaceWithWrongContainer(): void
    {
        self::expectException(UnsupportedContainerException::class);

        $this->subject->replaceMap('classA', 1);
    }
}