<?php

namespace DelTesting;

use Codeception\TestCase\Test;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class CommandTest extends Test
{
    /**
     * @param Command $command
     * @return mixed|string
     */
    public function runCommand(Command $command, array $args)
    {
        $application = new Application();
        $application->add($command);

        $commandName = $command->getName();
        $args = array_merge(array('command' => $commandName), $args);
        $command = $application->find($commandName);
        $commandTester = new CommandTester($command);
        $commandTester->execute($args);

        return $commandTester->getDisplay();
    }
}