<?php

namespace Lib;

use Lib\Exception\CommandNotFoundException;

class CommandRunner
{
    private CommandFactory $factory;
    private CommandClassMapInterface $classMap;

    public function __construct(CommandClassMapInterface $classMap)
    {
        $this->factory = new CommandFactory($classMap);
        $this->classMap = $classMap;
    }

    public function runWithArguments(array $argv): void
    {
        try {
            if (!isset($argv[1])) {
                $this->listAvailableCommands();

                die;
            }

            $commandName = $argv[1];
            $args = array_slice($argv, 2);

            $command = $this->factory->create($commandName);
            $input = new InputBag($args);

            $command->run($input);
        } catch (CommandNotFoundException) {
            echo 'Could not find command "' . $argv[1] . '"' . PHP_EOL;
        }
    }

    /**
     * @throws Exception\CommandNotFoundException
     */
    public function listAvailableCommands(): void
    {
        echo "List of available commands:\n";

        foreach ($this->classMap->getAvailableCommandNames() as $commandName) {
            $className = $this->classMap->getClassName($commandName);
            /** @var BaseCommand $command */
            $command = new $className();

            echo '    -  ' . $command->getName() . "  (" . $command->getDescription() . ')' . "\n";
        }
    }
}
