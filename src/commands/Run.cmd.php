<?php
namespace ChangeCalculator\Commands;

use ChangeCalculator\Calculator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Run extends Command
{

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('run')

            // the short description shown while running "php bin/console list"
            ->setDescription('Try out the application')

            // the full command description shown when running the command with
            // the "--help" option
            ->addArgument('totalCost', InputArgument::REQUIRED, 'The total cost of the product')
            ->addArgument('amountProvided', InputArgument::REQUIRED, 'The amount provided by the customer')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $totalCost = $input->getArgument('totalCost');
        $amountProvided = $input->getArgument('amountProvided');
        
        $calculator = new Calculator();
        
        $change = $calculator->change($totalCost, $amountProvided);
        
        var_dump($change);        
    }
}
