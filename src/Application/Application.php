<?php

declare(strict_types=1);

namespace Neuffer\Application;

use Neuffer\ClassFour;
use Neuffer\ClassOne;
use Neuffer\Classthree;
use Neuffer\ClassTwo;
use Neuffer\Enum\ActionEnum;
use Neuffer\Params\ParamsInterface;

class Application
{
    private ParamsInterface $params;

    public function __construct(ParamsInterface $params)
    {
        $this->params = $params;
    }

    public function run(): void
    {
        try {
            if ($this->params->getActionParam()->isAction(ActionEnum::SUM)) {
                $classOne = new ClassOne($this->params->getFileParam());
            } elseif ($this->params->getActionParam()->isAction(ActionEnum::MINUS)) {
                $classTwo = new ClassTwo($this->params->getFileParam(), ActionEnum::MINUS);
                $classTwo->start();
            } elseif ($this->params->getActionParam()->isAction(ActionEnum::MULTIPLY)) {
                $classThree = new Classthree();
                $classThree->setFile($this->params->getFileParam());
                $classThree->execute();
            } elseif ($this->params->getActionParam()->isAction(ActionEnum::DIVISION)) {
                $classFouyr = new classFour($this->params->getFileParam());
            } else {
                throw new \Exception("Wrong action is selected");
            }
        } catch (\Exception $exception) {}
    }
}