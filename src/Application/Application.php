<?php

declare(strict_types=1);

namespace Neuffer\Application;

use Neuffer\ClassFour;
use Neuffer\ClassOne;
use Neuffer\Classthree;
use Neuffer\ClassTwo;

class Application
{
    public function run(): void
    {
        $shortopts = "a:f:";
        $longopts  = array(
            "action:",
            "file:",
        );

        $options = getopt($shortopts, $longopts);

        if(isset($options['a'])) {
            $action = $options['a'];
        } elseif(isset($options['action'])) {
            $action = $options['action'];
        } else {
            $action = "xyz";
        }

        if(isset($options['f'])) {
            $file = $options['f'];
        } elseif(isset($options['file'])) {
            $file = $options['file'];
        } else {
            $file = "notexists.csv";
        }

        try {
            if ($action == "plus") {
                $classOne = new ClassOne($file);
            } elseif ($action == "minus") {
                $classTwo = new ClassTwo($file, "minus");
                $classTwo->start();
            } elseif ($action == "multiply") {
                $classThree = new Classthree();
                $classThree->setFile($file);
                $classThree->execute();
            } elseif ($action == "division") {
                $classFouyr = new classFour($file);
            } else {
                throw new \Exception("Wrong action is selected");
            }
        } catch (\Exception $exception) {}
    }
}