<?php
namespace Del\Common\Command;

use Del\Common\ContainerService;
use Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateProxy extends GenerateProxiesCommand
{


    protected function configure()
    {
        parent::configure();
        $this->setName('generate-proxies');
    }
}
