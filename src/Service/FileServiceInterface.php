<?php

declare(strict_types=1);

namespace Neuffer\Service;

interface FileServiceInterface
{
    /**
     * Get all file lines.
     *
     * @param string $filename Filename.
     *
     * @return string[]
     */
    public function fetchFileLines(string $filename): array;

    public function writeToFile(string $filename, array $data): bool;
}