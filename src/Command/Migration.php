<?php

namespace Del\Common\Command;

use Del\Common\ContainerService;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Migration extends MigrateCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setName('migrant');
        $this->addArgument('vendor', InputArgument::OPTIONAL, 'The vendor directory containing the migrations.');
        $this->addOption('configuration', null, InputOption::VALUE_OPTIONAL, 'The path to a migrations configuration file.');
        $this->addOption('db-configuration', null, InputOption::VALUE_OPTIONAL, 'The path to a database connection configuration file.');
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     */
    public function execute(InputInterface $input, OutputInterface $output): ?int
    {
        if ($path = $input->getArgument('vendor')) {
            $path = 'vendor/' . $path . '/migrations';
            $config = $this->getMigrationConfiguration($input, $output);
            $config->setMigrationsDirectory($path);
            $config->registerMigrationsFromDirectory($path);
            $this->setMigrationConfiguration($config);
        }
        
        return parent::execute($input, $output);
    }
}
