<?php
namespace ChangeCalculator\Commands;

use ChangeCalculator\Calculator;
use ChangeCalculator\Denominations;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Example1 extends Command
{

    private $d = [15, 10, 4];

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('example1')

            // the short description shown while running "php bin/console list"
            ->setDescription(sprintf('This command will create a change using these custom denominations: %s', var_export($this->d, true)))

            // the full command description shown when running the command with
            // the "--help" option
            ->addArgument('totalCost', InputArgument::OPTIONAL, 'The total cost of the product', 30)
            ->addArgument('amountProvided', InputArgument::OPTIONAL, 'The amount provided by the customer', 71)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Denominations::set($this->d);

        $totalCost = $input->getArgument('totalCost');
        $amountProvided = $input->getArgument('amountProvided');

        $calculator = new Calculator();

        $change = $calculator->change($totalCost, $amountProvided);

        var_dump($change);
    }
}
