<?php

namespace Lib;

use Lib\Exception\CommandNotFoundException;

interface CommandClassMapInterface
{
    /**
     * @throws CommandNotFoundException
     */
    public function getClassName(string $commandName): string;
    public function getAvailableCommandNames(): array;
}
