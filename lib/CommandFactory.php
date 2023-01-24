<?php

namespace Lib;

class CommandFactory
{
    private CommandClassMapInterface $classMap;

    public function __construct(CommandClassMapInterface $classMap)
    {
        $this->classMap = $classMap;
    }

    /**
     * @throws Exception\CommandNotFoundException
     */
    public function create(string $commandName): BaseCommand
    {
        $className = $this->classMap->getClassName($commandName);

        return new $className();
    }
}
