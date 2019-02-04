<?php
namespace ChangeCalculator;

class Change
{

    public $data;

    public function __construct(iterable $data)
    {
        $this->data = $data;
    }
}
