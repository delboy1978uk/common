<?php
namespace Del\Common\Command;

use Symfony\Component\Console\Command\Command;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\Migration as DoctrineMigration;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


class Migration extends Command
{
    private $migrationPaths = ['migrations'];
    private $entityPaths = ['src/Entity'];

    public function execute(InputInterface $input, OutputInterface $output)
    {
        die('do shit!');
    }


    protected function configure()
    {
        $this
            ->setName('delboy1978uk:migrate')
            ->setDescription('Execute migrations in a vendor package')
            ->addArgument('migrations-directory', InputArgument::REQUIRED, 'The directory containing the migrations.')
            ->addArgument('entity-directory', InputArgument::REQUIRED, 'The directory containing the migrations.')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command executes migrate in a specified directory

    <info>%command.full_name% foldername</info>
EOT
            );

        parent::configure();
    }
}