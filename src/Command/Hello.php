<?php

namespace Equip\Console\Command;

use Redis;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Hello extends Command
{
    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
        
        parent::__construct(null);
    }
    

    protected function configure()
    {
        $this
            ->setName('hello')
            ->setDescription('Example command')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to say hello to?'
            );
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $name = $input->getArgument('name') ?: 'world';
        
        $output->writeln(sprintf('Hello, %s!', $name));
    }
}
