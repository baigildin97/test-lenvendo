<?php

namespace Lib;

class InputBag
{
    private array $arguments = [];
    private array $options = [];

    public function __construct(array $args)
    {
        foreach ($args as $arg) {
            $this->parseArgument($arg);
        }
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getOption(string $key): array
    {
        return $this->options[$key];
    }

    private function parseArgument(string $argument): void
    {
        if ($argument[0] === '[') {
            [$optionName, $optionValue] = explode('=', trim($argument, '[]'));

            $this->options[$optionName][] = $optionValue;
        } else {
            $argument = str_replace('}{', ',', trim($argument, '{}'));
            $argument = explode(',', $argument);

            foreach ($argument as $singleArgument) {
                $this->arguments[] = $singleArgument;
            }
        }
    }
}
