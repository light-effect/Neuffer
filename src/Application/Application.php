<?php

declare(strict_types=1);

namespace Neuffer\Application;

use Neuffer\ActionStrategy\ActionInterface;
use Neuffer\Params\ParamsInterface;
use Neuffer\Service\FileServiceInterface;
use Psr\Log\LoggerInterface;

class Application
{
    private ParamsInterface $params;

    private FileServiceInterface $fileService;

    private ActionInterface $action;

    private LoggerInterface $logger;

    public function __construct(
        ParamsInterface $params,
        ActionInterface $action,
        FileServiceInterface $fileService,
        LoggerInterface $logger
    ) {
        $this->params      = $params;
        $this->action      = $action;
        $this->fileService = $fileService;
        $this->logger      = $logger;
    }

    public function run(): void
    {
        $this->logger->log(0, 'Started ' . $this->params->getActionParam()->toString() . ' operation');

        $data = $this->prepareData();

        $this->fileService->writeToFile('result.csv', $data);

        $this->logger->log(0, 'Finished ' . $this->params->getActionParam()->toString() . ' operation');
    }

    public function prepareData(): array
    {
        $data = [];

        foreach ($this->fileService->fetchFileLines($this->params->getFileParam()) as $line) {
            try {
                $numbers = explode(';', $line);
                $a = (int) $numbers[0];
                $b = (int) $numbers[1];

                $result = $this->action->action($a, $b);

                if ($this->isValid($result)) {
                    $data[] = implode(';', [$a, $b, $result]);

                    continue;
                }

                $this->logger->log(0, 'numbers ' . $a . ' and ' . $b . ' are wrong');
            } catch (\Exception $exception) {

            }
        }

        return $data;
    }

    private function isValid(int $result): bool
    {
        return $result > 0;
    }
}