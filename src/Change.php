<?php
namespace ChangeCalculator;

class Change
{

    public $change;
    public $bill;

    public function __construct(float $change, iterable $data)
    {
        $this->change = $change;
        $this->bill = $data;
    }
}
