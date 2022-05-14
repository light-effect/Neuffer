<?php

declare(strict_types=1);

namespace Neuffer\Service;

interface FileServiceInterface
{
    public function fetchFileLines(string $filename): array;

    public function writeToFile(string $filename, array $data): bool;
}