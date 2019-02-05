<?php
namespace ChangeCalculator;

use ChangeCalculator\Exceptions\ChangeCalculatorException;

final class Denominations
{

    private static $denominations = null;

    private function __construct()
    {
        
    }

    private function __clone()
    {
        
    }

    private function __wakeup()
    {
        
    }

    public static function get()
    {

        if (true === is_array(self::$denominations)) {
            return self::$denominations;
        }

        $denominations = parse_ini_file('config.ini', false, INI_SCANNER_TYPED);

        if (false === $denominations || false === isset($denominations['denominations'])) {
            throw new ChangeCalculatorException("Bad denominations settings provided");
        }

        self::$denominations = $denominations['denominations'];

        // Sorting the denomination bills
        rsort(self::$denominations);

        return self::$denominations;
    }

    public static function set(iterable $customDenominations)
    {
        self::$denominations = $customDenominations;
    }
}
