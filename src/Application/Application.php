<?php

declare(strict_types=1);

namespace Neuffer\Application;

use Neuffer\ActionStrategy\ActionInterface;
use Neuffer\Params\ParamsInterface;
use Neuffer\Service\FileServiceInterface;

class Application
{
    private ParamsInterface $params;

    private FileServiceInterface $fileService;

    private ActionInterface $action;

    public function __construct(ParamsInterface $params, ActionInterface $action, FileServiceInterface $fileService)
    {
        $this->params      = $params;
        $this->action      = $action;
        $this->fileService = $fileService;
    }

    public function run(): void
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
            } catch (\Exception $exception) {

            }
        }

        $this->fileService->writeToFile('result.csv', $data);
    }

    private function isValid(int $result): bool
    {
        return $result > 0;
    }
}