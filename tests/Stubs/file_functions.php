<?php

declare(strict_types=1);

namespace Neuffer;

use \Stubs\FileHelper;

function fopen(string $filename, string $mode)
{
    if ($filename === 'result.csv' || $filename === 'log.txt') {
        return $filename;
    }
    FileHelper::$i = 0;

    return $filename;
}

function fgetcsv($stream, ?int $length = null, string $separator = ',', string $enclosure = '"', string $escape = '\\')
{
    if (FileHelper::$i > count(FileHelper::$data) - 1) {
        return false;
    }

    $result = FileHelper::$data[FileHelper::$i];

    FileHelper::$i++;

    return $result;
}

function fgets($stream, ?int $length = null)
{
    if (FileHelper::$i > count(FileHelper::$data) - 1) {
        return false;
    }

    $result = FileHelper::$data[FileHelper::$i];

    FileHelper::$i++;

    return $result;
}

function fclose($stream): bool {
    return true;
}

function fwrite($stream, string $data, ?int $length = null) {
    if ($stream === 'result.csv') {
        FileHelper::$result[] = $data;
    }

    if ($stream === 'log.txt') {
        FileHelper::$log[] = $data;
    }

    return 1;
}

function file_exists(string $filename): bool
{
    return true;
}

function unlink(string $filename): bool {
    return true;
}

function is_readable(string $filename): bool {
    return true;
}