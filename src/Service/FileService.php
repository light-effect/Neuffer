<?php

declare(strict_types=1);

namespace Neuffer\Service;

use Neuffer\Exception\FileNotFoundException;

class FileService implements FileServiceInterface
{
    public function fetchFileLines(string $filename): array
    {
        $data = [];

        if (file_exists($filename) === false) {
            throw new FileNotFoundException();
        }

        $file = fopen($filename,'r');

        while (($line = fgets($file)) !== false) {
            $data[] = $line;
        }

        fclose($file);

        return $data;
    }

    public function writeToFile(string $filename, array $data): bool
    {
        $fp = fopen($filename, 'a+');

        fwrite($fp, implode(PHP_EOL, $data) . PHP_EOL);

        return fclose($fp);
    }
}