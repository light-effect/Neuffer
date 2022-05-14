<?php

declare(strict_types=1);

namespace Neuffer\Application;

use Neuffer\ActionStrategy\ActionInterface;
use Neuffer\Params\ParamsInterface;
use Neuffer\Service\FileServiceInterface;
use Psr\Log\LoggerInterface;

class Application
{
    public const RESULT_FILE = 'result.csv';

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

        if ($data !== []) {
            $this->fileService->writeToFile(self::RESULT_FILE, $data);
        }

        $this->logger->log(0, 'Finished ' . $this->params->getActionParam()->toString() . ' operation');
    }

    public function prepareData(): array
    {
        $data = [];

        foreach ($this->fileService->fetchFileLines($this->params->getFileParam()) as $line) {
            [$a, $b] = explode(';', $line);

            $result = $this->action->action((int) $a, (int) $b);

            if ($this->isValid($result)) {
                $data[] = implode(';', [trim($a), trim($b), $result]);

                continue;
            }

            $this->logger->log(0, 'numbers ' . trim($a) . ' and ' . trim($b) . ' are wrong');
        }

        return $data;
    }

    private function isValid(int $result): bool
    {
        return $result > 0;
    }
}