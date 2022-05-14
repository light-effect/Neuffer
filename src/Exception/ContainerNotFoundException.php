<?php

declare(strict_types=1);

namespace Neuffer\Exception;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

class ContainerNotFoundException extends Exception implements NotFoundExceptionInterface
{

}
