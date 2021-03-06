<?php
namespace Rena\Tasks;

use JBZoo\PimpleDumper\PimpleDumper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateRena extends Command
{
    protected function configure()
    {
        $this
            ->setName("update:rena")
            ->setDescription("Updates composer and the phpstorm meta");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $container;

        // Dump the Pimple.json and .phpstorm.meta.php
        $dumper = new PimpleDumper();
        $dumper->dumpPhpstorm($container);

        // Update Composer
    }
}