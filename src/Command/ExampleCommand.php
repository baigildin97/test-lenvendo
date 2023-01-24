<?php

namespace App\Command;

use Lib\BaseCommand;
use Lib\InputBag;

class ExampleCommand extends BaseCommand
{
    public function __construct()
    {
        $this->description = 'Lists all arguments and options';
        $this->name = 'example_command';
    }

    protected function execute(InputBag $args): void
    {
        $this->listArguments($args->getArguments());
        $this->listOptions($args->getOptions());
    }

    private function listArguments(array $arguments): void
    {
        echo "Arguments:\n";

        foreach ($arguments as $argument) {
            echo "    -  $argument\n";
        }
    }

    private function listOptions(array $options): void
    {
        echo "Options:\n";

        foreach ($options as $optionName => $optionValues) {
            echo "    -  $optionName\n";

            foreach ($optionValues as $optionValue) {
                echo "        -  $optionValue\n";
            }
        }
    }
}
