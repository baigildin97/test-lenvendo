<?php

require 'vendor/autoload.php';

use App\CommandClassMap;
use Lib\CommandRunner;

$commandRunner = new CommandRunner(new CommandClassMap());

$commandRunner->runWithArguments($argv);
