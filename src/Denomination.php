<?php
namespace ChangeCalculator;

class Denomination
{

    public $denomination;
    public $quantity;

    public function __construct(float $denomination, int $quantity = 0)
    {
        $this->denomination = $denomination;
        $this->quantity = $quantity;
    }
}
