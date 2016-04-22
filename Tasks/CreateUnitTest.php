<?php
namespace Rena\Tasks;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUnitTest extends Command
{
    protected function configure()
    {
        $this
            ->setName("create:unittest")
            ->setDescription("Create a unit test");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Createunittest task");
    }
}