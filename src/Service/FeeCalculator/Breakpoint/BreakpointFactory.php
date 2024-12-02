<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint;

class BreakpointFactory
{
    private const ONE_YEAR = 12;

    private const TWO_YEARS = 24;

    public static function create(int $term): BreakpointInterface
    {
        switch ($term) {
            case self::TWO_YEARS:
                return new TwoYearsLoanBreakpoints();
            case self::ONE_YEAR:
            default:
                return new OneYearLoanBreakpoints();
        }
    }
}
