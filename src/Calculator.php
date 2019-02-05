<?php
namespace ChangeCalculator;

use ChangeCalculator\Exceptions\ChangeCalculatorException;

class Calculator
{

    /**
     * 
     * @param float $totalCost
     * @param float $amountProvided
     * @throws ChangeCalculatorException
     */
    public function change(float $totalCost, float $amountProvided): Change
    {
        if ($amountProvided < $totalCost) {
            throw new ChangeCalculatorException('The amount provided is less that total cost');
        }
        
        $change = $amountProvided - $totalCost;
        
        $result = $this->calculateChange($change);

        if (false === $result) {
            throw new ChangeCalculatorException('Impossible make a change with the current denominations');
        }

        return new Change($change, $result);
    }

    /**
     * 
     * @param float $change
     * @param int $index
     * @return boolean|array
     */
    private function calculateChange(float $change, int $index = 0)
    {
        $result = [];

        if ($change === 0.0) {
            return $result;
        }
        if ($change < 0.0) {
            return false;
        }
        
        $denominations = Denominations::get();
        
        for ($i = $index; $i < count($denominations); $i++) {
            $denomination = $denominations[$i];
            $tmp = [];

            if ($change < $denomination) {
                $tmp[] = new Denomination($denomination);

                $sub = $this->calculateChange($change, $i + 1);
            } else {
                $tmp[] = new Denomination($denomination, (int) ($change / $denomination));

                $remain = \bcsub($change, \bcmul(end($tmp)->quantity, $denomination, 2), 2);

                $sub = $this->calculateChange($remain, $i + 1);
            }

            if (false !== $sub) { // found a valid solution.
                $result = array_merge($result, $tmp, $sub);
                break;
            }
            // backtracking. try different path
        }

        return count($result) > 0 ? $result : false;
    }
}
