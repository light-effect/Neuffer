<?php

declare(strict_types=1);

namespace Neuffer\Exception;

use Exception;
use Throwable;

class UnsupportedActionException extends Exception
{
    public function __construct($action = "", $code = 0, Throwable $previous = null)
    {
        $message = 'This action: ' . $action . ' unsupported';

        parent::__construct($message, $code, $previous);
    }
}