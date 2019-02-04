<?php

class Calculator {

    public function plus($a, $b) {
        return $a + $b;
    }

    public function minus($a, $b) {
        return $a - $b;
    }

    public function multiply($a, $b) {
        return $a * $b;
    }

    public function divide($a, $b) {
        if ($b == 0) {
            throw new InvalidArgumentException('Cannot divide by zero');
        }
        return $a / $b;
    }

    public function modulo($a, $b) {
        return $a % $b;
    }

}
