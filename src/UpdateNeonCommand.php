<?php

namespace Instante\NeonConfigurator;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateNeonCommand extends Command
{
    const COMMAND_ID = 'instante:neon:update';

    protected function configure()
    {
        $this
            ->setName(self::COMMAND_ID)
            ->setDescription('Updates a NEON file.')
            ->addArgument('pathToNeon', InputArgument::REQUIRED, 'Path to neon file')
            ->addArgument('key', InputArgument::REQUIRED, 'Key to be added/updated, i.e. parameters.webmasterEmail')
            ->addArgument('value', InputArgument::REQUIRED, 'New value to be set')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pathToNeon = $input->getArgument('pathToNeon');
        $key = $input->getArgument('key');
        $value = $input->getArgument('value');

        $neonEditor = new NeonEditor($pathToNeon);
        $neonEditor->setByKey($key, $value);
        $neonEditor->save();
        $output->writeln(sprintf('%s: "%s" set to "%s"', basename($pathToNeon), $key, $value));
    }
}
