<?php
namespace Del\Common\Command;

use Del\Common\ContainerService;
use Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Migration extends MigrateCommand
{


    protected function configure()
    {

        $this
            ->setName('migrate')
            ->setDescription('Execute migrations.')
            ->addArgument('vendor', InputArgument::OPTIONAL, 'The vendor directory containing the migrations.')
            ->addArgument('version', InputArgument::OPTIONAL, 'The version number (YYYYMMDDHHMMSS) or alias (first, prev, next, latest) to migrate to.', 'latest')
            ->addOption('write-sql', null, InputOption::VALUE_NONE, 'The path to output the migration SQL file instead of executing it.')
            ->addOption('dry-run', null, InputOption::VALUE_NONE, 'Execute the migration as a dry run.')
            ->addOption('query-time', null, InputOption::VALUE_NONE, 'Time all the queries individually.')
            ->addOption('allow-no-migration', null, InputOption::VALUE_NONE, 'Don\'t throw an exception if no migration is available (CI).')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command executes migrate in a specified directory

    <info>%command.full_name% foldername</info>

    The <info>%command.name%</info> command executes a migration to a specified version or the latest available version:

    <info>%command.full_name%</info>

You can optionally manually specify the version you wish to migrate to:

    <info>%command.full_name% YYYYMMDDHHMMSS</info>

You can specify the version you wish to migrate to using an alias:

    <info>%command.full_name% prev</info>

You can also execute the migration as a <comment>--dry-run</comment>:

    <info>%command.full_name% YYYYMMDDHHMMSS --dry-run</info>

You can output the would be executed SQL statements to a file with <comment>--write-sql</comment>:

    <info>%command.full_name% YYYYMMDDHHMMSS --write-sql</info>

Or you can also execute the migration without a warning message which you need to interact with:

    <info>%command.full_name% --no-interaction</info>

You can also time all the different queries if you wanna know which one is taking so long:

    <info>%command.full_name% --query-time</info>
EOT
            );
        $this->addOption('configuration', null, InputOption::VALUE_OPTIONAL, 'The path to a migrations configuration file.');
        $this->addOption('db-configuration', null, InputOption::VALUE_OPTIONAL, 'The path to a database connection configuration file.');
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
        if ($path = $input->getArgument('vendor')) {
            $path = 'vendor/'.$path.'/migrations';
            $config = $this->getMigrationConfiguration($input, $output);
            $config->setMigrationsDirectory($path);
            $config->registerMigrationsFromDirectory($path);
            $this->setMigrationConfiguration($config);
        }
        parent::execute($input, $output);
    }
}
