<?php

namespace App;

use App\Command\ExampleCommand;
use Lib\CommandClassMapInterface;
use Lib\Exception\CommandNotFoundException;

class CommandClassMap implements CommandClassMapInterface
{
    private static array $classMap = [
        'example_command' => ExampleCommand::class,
    ];

    /**
     * @throws CommandNotFoundException
     */
    public function getClassName(string $commandName): string
    {
        if (!array_key_exists($commandName, static::$classMap)) {
            throw new CommandNotFoundException();
        }

        return static::$classMap[$commandName];
    }

    public function getAvailableCommandNames(): array
    {
        return array_keys(static::$classMap);
    }
}
