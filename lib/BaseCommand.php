<?php

namespace Lib;

abstract class BaseCommand
{
    protected string $description;
    protected string $name;

    public function help(): void
    {
        echo $this->description . "\n";
    }

    public function run(InputBag $args): void
    {
        echo 'Called command: ' . $this->name . "\n";

        if (in_array('help', $args->getArguments())) {
            $this->help();

            return;
        }

        $this->execute($args);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    abstract protected function execute(InputBag $args): void;
}
