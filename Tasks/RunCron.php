<?php
namespace Rena\Tasks;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Runcron extends Command
{
    protected function configure()
    {
        $this
            ->setName("run:cron")
            ->setDescription("Run cronjobs");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Runcron task");
    }
}